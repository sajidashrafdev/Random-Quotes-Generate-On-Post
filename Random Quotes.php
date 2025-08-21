<?php

/*
 * Plugin Name:       Random Quotes
 * Description:       Display random quotes on posts.
 * Version:           1.0.0
 * Author:            Sajid Ashraf
 */



// Array of quotes
$quotes = array(
    "The only limit to our realization of tomorrow is our doubts of today.",
    "The future belongs to those who believe in the beauty of their dreams.",
    "Do not wait to strike till the iron is hot, but make it hot by striking.",
    "Success usually comes to those who are too busy to be looking for it.",
    "You miss 100% of the shots you don’t take."
);


// Display random quote admin page
function random_quotes_page()
{
?>
    <div class="wrap">
        <h1>View All Quotes</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Sr.</th>
                <th>Quote</th>
            </tr>
            <tr>
                <?php
                for ($i = 0; $i < count($GLOBALS['quotes']); $i++) {
                    echo '<tr>';
                    echo '<td>' . ($i + 1) . '</td>';
                    echo '<td>' . $GLOBALS['quotes'][$i] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tr>
        </table>
    </div>
<?php

}

function add_new_quote_page()
{
?>
    <h1>Add New Quote</h1>
    <form method="post" action="">
        <textarea name="new_quote" rows="5" cols="50"></textarea><br>
        <input type="submit" value="Add Quote">
    </form>
    <?php
    if (isset($_POST['new_quote'])) {
        $new_quote = $_POST['new_quote'];
        $GLOBALS['quotes'][] = $new_quote; // Add new quote to the global quotes array
        echo '<div class="updated"><p>Quote added successfully!</p></div>';
    }
}


// Add admin menu
add_action('admin_menu', 'random_quotes_display');
function random_quotes_display()
{

    // Add main menu
    add_menu_page(
        'Random Quotes',
        'Random Quotes',
        'manage_options',
        'random-quotes',
        'random_quotes_page',
        'dashicons-format-quote',
        20
    );

    // Add submenu for adding new quote
    add_submenu_page(
        'random-quotes',      // Parent slug
        'Add New Quote',      // Page title
        'Add New Quote',      // Menu title (this was wrong)
        'manage_options',     // Capability
        'add-new-quote',      // Menu slug
        'add_new_quote_page'  // Callback
    );
}

// Display random quote on post content
add_filter('the_content', 'random_quotes_on_post');
function random_quotes_on_post()
{
    $random_quote = $GLOBALS['quotes'][(rand(0, 4))];
    return '<blockquote>' . $random_quote . '</blockquote>';
}
?>