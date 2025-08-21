<?php

/*
 * Plugin Name:       Random Quotes
 * Description:       Display random quotes on posts.
 * Version:           1.0.0
 * Author:            Sajid Ashraf
 */


$quotes = array(
    "The only limit to our realization of tomorrow is our doubts of today.",
    "The future belongs to those who believe in the beauty of their dreams.",
    "Do not wait to strike till the iron is hot, but make it hot by striking.",
    "Success usually comes to those who are too busy to be looking for it.",
    "You miss 100% of the shots you don’t take."
);

function random_quotes_page()
{
    $random_quote = $GLOBALS['quotes'][(rand(0, 4))];
?>
    <div class="wrap">
        <h1>Random Quote</h1>
        <blockquote>
            <h2><?php echo $random_quote; ?></h2>
        </blockquote>
    </div>
<?php

}

add_filter('the_content', 'random_quotes_on_post');
function random_quotes_on_post() {
    $random_quote = $GLOBALS['quotes'][(rand(0, 4))];
    return '<blockquote>' . $random_quote . '</blockquote>';
}


add_action('admin_menu', 'random_quotes_display');
function random_quotes_display()
{
    add_menu_page(
        'Random Quotes',
        'Random Quotes',
        'manage_options',
        'random-quotes',
        'random_quotes_page',
        'dashicons-format-quote',
        20
    );
}

?>