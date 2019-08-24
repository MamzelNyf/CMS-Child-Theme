<?php
/*
  Plugin Name: Social Profile Widget
  Description: Links to social media profiles
  Author: Fanny LEFERT
  Author URI: https://creativeontheroad.com
 */

// Adds Social_Media_Widget

class Social_Media_Profile extends WP_Widget
{
//Register media widget with database.
    function __construct()
    {
        parent::__construct(
            'Social_Media_Profile',
            __('Social Media Profiles', 'translation_domain'), // Name of widget in WP dashboard
            array('description' => __('Links to Chef on social media', 'translation_domain'),)
        );
    }
    public function widget($args, $instance)
    {
        //Connect variable to form name and apply filter to title to do the same
        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $pinterest = $instance['pinterest'];
        $linkedin = $instance['linkedin'];

        //Variable for HTML to post fontawesome icons
        $facebook_profile = '<a class="facebook" href="' . $facebook . '"><i class="fab fa-facebook"></i></a>';
        $twitter_profile = '<a class="twitter" href="' . $twitter . '"><i class="fa fa-twitter"></i></a>';
        $pinterest_profile = '<a class="pinterest" href="' . $pinterest . '"><i class="fab fa-pinterest"></i></a>';
        $linkedin_profile = '<a class="linkedin" href="' . $linkedin . '"><i class="fa fa-linkedin"></i></a>';

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        //Only post HTML of completed fomrm fields
        echo '<div class="social-icons">';
        echo (!empty($facebook)) ? $facebook_profile : null;
        echo (!empty($twitter)) ? $twitter_profile : null;
        echo (!empty($pinterest)) ? $pinterest_profile : null;
        echo (!empty($linkedin)) ? $linkedin_profile : null;
        echo '</div>';

        echo $args['after_widget'];
    }
    public function form($instance)
    {
        //Set initial values of each from fields as starting point
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'My Social Profile' : null;
        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        isset($instance['pinterest']) ? $pinterest = $instance['pinterest'] : null;
        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        ?>
​
<!-----------THE FORM------------------>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('facebook:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('twitter:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id(''); ?>"><?php _e('pinterest:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>">
</p>
​
<p>
    <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('linkedin:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
</p>
​
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        //Check to see if new value has been entered in form field then strip of unwanted html
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook'])) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter'])) ? strip_tags($new_instance['twitter']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest'])) ? strip_tags($new_instance['pinterest']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin'])) ? strip_tags($new_instance['linkedin']) : '';

        return $instance;
    }
}

// register Social_Profile widget
function register_social_profile()
{
    register_widget('Social_Media_Profile');
}

add_action('widgets_init', 'register_social_profile');