<?php
class WC_Gateway_Iamport_Phone extends Base_Gateway_Iamport {

	public function __construct() {
		parent::__construct();

		$this->method_title = __( '아임포트(휴대폰소액결제)', 'iamport-for-woocommerce' );
		$this->method_description = __( '=> 아임포트 서비스를 이용해 결제모듈을 연동할 수 있습니다.<br>=> [아임포트] X PG사 제휴할인혜택을 받아보세요! <a href="http://www.iamport.kr/pg#promotion" target="_blank">다날과 계약 후 이용하시면 보다 합리적인 수수료, 정산주기 조건으로 휴대폰결제 서비스를 이용하실 수 있습니다.</a><br><br>=> 아임포트의 최신 공지사항도 놓치지 마세요! <a href="http://www.iamport.kr/notice" target="_blank">공지사항보기</a>', 'iamport-for-woocommerce' );
		$this->has_fields = true;
		$this->supports = array( 'products', 'refunds' );

		//settings
		$this->title = $this->settings['title'];
		$this->description = $this->settings['description'];

		//actions
		// add_action( 'woocommerce_thankyou_'.$this->id, array( $this, 'iamport_order_detail' ) ); woocommerce_order_details_after_order_table 로 대체. 중복으로 나오고 있음
	}

	protected function get_gateway_id() {
		return 'iamport_phone';
	}

	public function init_form_fields() {
		parent::init_form_fields();

		$this->form_fields = array_merge( array(
			'enabled' => array(
				'title' => __( 'Enable/Disable', 'woocommerce' ),
				'type' => 'checkbox',
				'label' => __( '아임포트(휴대폰소액결제) 결제 사용', 'iamport-for-woocommerce' ),
				'default' => 'yes'
			),
			'danal_user' => array(
				'title' => __( '다날을 통해 휴대폰결제 사용', 'iamport-for-woocommerce' ),
				'type' => 'checkbox',
				'label' => __( '다날 계약을 통해 휴대폰결제 사용 중이시면 체크해주세요.', 'iamport-for-woocommerce' ),
				'default' => 'no'
			),
			'title' => array(
				'title' => __( 'Title', 'woocommerce' ),
				'type' => 'text',
				'description' => __( '구매자에게 표시될 구매수단명', 'iamport-for-woocommerce' ),
				'default' => __( '휴대폰소액결제 결제', 'iamport-for-woocommerce' ),
				'desc_tip'      => true,
			),
			'description' => array(
				'title' => __( 'Customer Message', 'woocommerce' ),
				'type' => 'textarea',
				'description' => __( '구매자에게 결제수단에 대한 상세설명을 합니다.', 'iamport-for-woocommerce' ),
				'default' => __( '주문확정 버튼을 클릭하시면 휴대폰소액결제 결제창이 나타나 결제를 진행하실 수 있습니다.', 'iamport-for-woocommerce' )
			),
			'digital_contents' => array(
				'title' => __( '디지털 상품', 'iamport-for-woocommerce' ),
				'description' => __( '판매하시는 상품이 배송되는 형태의 실물이 아니라 디지털 파일 등 무형의 서비스 상품이라면 체크해주세요(통신사 필수 요구사항)', 'iamport-for-woocommerce' ),
				'type' => 'checkbox',
				'label' => __( '디지털 상품인 경우 체크해주세요', 'iamport-for-woocommerce' ),
				'default' => 'no'
			),
		), $this->form_fields);
	}

	public function iamport_order_detail( $order_id ) {
		global $woocommerce;

		$order = new WC_Order( $order_id );

		$paymethod = get_post_meta($order_id, '_iamport_paymethod', true);
		$receipt_url = get_post_meta($order_id, '_iamport_receipt_url', true);
		$vbank_name = get_post_meta($order_id, '_iamport_vbank_name', true);
		$vbank_num = get_post_meta($order_id, '_iamport_vbank_num', true);
		$vbank_date = get_post_meta($order_id, '_iamport_vbank_date', true);
		$tid = $order->get_transaction_id();

        ob_start();
		?>
		<h2><?=__( '결제 상세', 'iamport-for-woocommerce' )?></h2>
		<table class="shop_table order_details">
			<tbody>
				<tr>
					<th><?=__( '결제수단', 'iamport-for-woocommerce' )?></th>
					<td><?=__( '휴대폰소액결제', 'iamport-for-woocommerce' )?></td>
				</tr>
				<tr>
					<th><?=__( '매출전표', 'iamport-for-woocommerce' )?></th>
					<td><a target="_blank" href="<?=$receipt_url?>"><?=sprintf( __( '영수증보기(%s)', 'iamport-for-woocommerce' ), $tid )?></a></td>
				</tr>
			</tbody>
		</table>
        <?php 
		ob_end_flush();
	}

	public function iamport_payment_info( $order_id ) {
		$iamport_info = parent::iamport_payment_info( $order_id );
		$iamport_info['digital'] = filter_var($this->settings['digital_contents'], FILTER_VALIDATE_BOOLEAN);

		$is_danal_user = filter_var($this->settings['danal_user'], FILTER_VALIDATE_BOOLEAN);
		if ( $is_danal_user )	$iamport_info['pg'] = 'danal';

		return $iamport_info;
	}

}