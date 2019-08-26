<?php
/*
Plugin Name: Legend Detail Widget
Description: Add some details to the legend
Author: Fanny LEFERT
Author URI: https://creativeontheroad.com
 */

// Adds Legend details

class Legend_Detail extends WP_Widget
{
//Register media widget with database.
    function __construct()
    {
        parent::__construct(
            'Legend_Detail',
            __('Legend Detail', 'translation_domain'), // Name of widget in WP dashboard
            array('description' => __('Details for legend', 'translation_domain'),)
        );
    }
    public function widget($args, $instance)
    {
        //Connect variable to form name and apply filter to title to do the same
        $title = apply_filters('widget_title', $instance['title']);
        $price = $instance['price'];
        $difficulty = $instance['difficulty'];
        $topic = $instance['topic'];

        //Variable for HTML
        $price_profile = '<p>' . $price . '</p>';
        $difficulty_profile = '<p>' . $difficulty . '</p>';
        $topic_profile = '<p>' . $topic . '</p>';

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        //Only post HTML of completed form fields
        echo '<div class="legend-detail">';
        echo (!empty($price)) ? $price_profile : null;
        echo (!empty($difficulty)) ? $difficulty_profile : null;
        echo (!empty($topic)) ? $topic_profile : null;
        echo '</div>';

        echo $args['after_widget'];
    }
    public function form($instance)
    {
        //Set initial values of each from fields as starting point
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'Legend details' : null;
        isset($instance['price']) ? $price = $instance['price'] : null;
        isset($instance['difficulty']) ? $difficulty = $instance['difficulty'] : null;
        isset($instance['topic']) ? $topic = $instance['topic'] : null;
        ?>
​
<!-----------THE FORM------------------>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id('price'); ?>"><?php _e('price:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('price'); ?>" name="<?php echo $this->get_field_name('price'); ?>" type="text" value="<?php echo esc_attr($price); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id('difficulty'); ?>"><?php _e('difficulty:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('difficulty'); ?>" name="<?php echo $this->get_field_name('difficulty'); ?>" type="text" value="<?php echo esc_attr($difficulty); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id('topic'); ?>"><?php _e('topic:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('topic'); ?>" name="<?php echo $this->get_field_name('topic'); ?>" type="text" value="<?php echo esc_attr($topic); ?>">
</p>
​
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        //Check to see if new value has been entered in form field then strip of unwanted html
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['price'] = (!empty($new_instance['price'])) ? strip_tags($new_instance['price']) : '';
        $instance['difficulty'] = (!empty($new_instance['difficulty'])) ? strip_tags($new_instance['difficulty']) : '';
        $instance['topic'] = (!empty($new_instance['topic'])) ? strip_tags($new_instance['topic']) : '';

        return $instance;
    }
}

// register Legend Detail widget
function register_legend_detail()
{
    register_widget('Legend_Detail');
}

add_action('widgets_init', 'register_legend_detail');