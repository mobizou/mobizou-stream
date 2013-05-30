<?php

add_action( 'widgets_init', function(){
    return register_widget( 'Mobizou_Stream_Widget' );
});

class Mobizou_Stream_Widget extends WP_Widget {
    
	public function __construct() {
		parent::__construct(
	 		'mobizou_stream', // Base ID
			'Mobizou Stream', // Name
			array( 'description' => "Publish Mobizou stream on your website!" ) // Args
		);
	}  
    public function update( $new_instance, $old_instance ) {        
	    $instance = array();
		$instance['num'] = intval( $new_instance['num'] );
		$instance['key'] =  $new_instance['key'] ;
		$instance['style'] = $new_instance['style'] ;
		$instance['title'] = $new_instance['title'] ;		
		return $instance;
	}
	
    public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
		    $title = $instance[ 'title' ];
			$num = $instance[ 'num' ];
			$key = $instance[ 'key' ];
			$style = $instance[ 'style' ];
		}
		else {
			$title = __( 'Specials', 'mobizou_stream' );
			$num = 5;
			$style = "list";
			$key = "";
		}
		?>
    <p>
        <label for="mobizou_stream-title"><?php _e('Title:'); ?> <input style="width: 250px;" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo htmlspecialchars($title); ?>" /></label>        
    </p>
    <p>
        <label for="mobizou_stream-key"><?php _e('Company Key:'); ?> <input style="width: 250px;" id="<?php echo $this->get_field_id( 'key' ); ?>" name="<?php echo $this->get_field_name( 'key' ); ?>" type="text" value="<?php echo htmlspecialchars($key); ?>" /></label>
        <small>Get your company key at <a target=_blank href="http://merchant.mobizou.com">http://merchant.mobizou.com</a></small>
    </p>
    
    <p>
        <label for="mobizou_stream-num"><?php _e('Number of items:'); ?> <input style="width: 50px;" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo $num; ?>" /></label>
        <small>Leave empty for unlimited</small>
    </p>
    <p>
        <label for="mobizou_stream-style"><?php _e('View:'); ?> <select style="width: 250px;" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>"><option value="list" <?php echo $style=="list" ? "selected" : ""; ?>>List</option><option value="grid" <?php echo $style=="grid" ? "selected" : ""; ?>>Grid</option></select></label>    
	</p>
    <?php
    }
  
  
    public function widget( $args, $options ) {
		global $post;
		
		extract( $args );				
		$title = apply_filters( 'widget_title', $options['title'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
				
        $num = $options['num'];
        $style = $options['style'];
        $company = $options['key'];
        if(!$company) {
            echo "Get your company key at <a target=_blank href=\"http://merchant.mobizou.com\">http://merchant.mobizou.com</a> and update the widget options box.";
        } else {
        ?>
        <div id="mobizou_widget" data-company="<?php echo $company; ?>" data-style="<?php echo $style; ?>" data-num="<?php echo $num; ?>"></div>
        <?php
        }
        echo $after_widget;
        
        wp_register_script('mobizou-stream', 'http://beta.mobizou.com/js/widget.js', array(), '1.0',true);
        wp_enqueue_script('mobizou-stream');
    }
  
}