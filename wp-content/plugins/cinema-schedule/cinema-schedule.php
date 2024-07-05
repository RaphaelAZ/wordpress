<?php
/*
Plugin Name: Plugin Horaires Films
Description: Gestionnaire d'horaires pour les films.
Version: 1.0
Author: Azevedo Raphaeël
*/

register_activation_hook(__FILE__, 'create_showtime_table');

function create_showtime_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'showtime';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        film text NOT NULL,
        showtime text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


add_action('admin_menu', 'showtime_menu');

function showtime_menu() {
    add_menu_page(
        "Liste d'horaires",
        "Liste d'horaires",
        'manage_options',
        'showtime-list',
        'showtime_list_page',
        'dashicons-list-view',
        6
    );
}


function showtime_list_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'showtime';

    // Ajouter un film avec des horaires
    if (isset($_POST['new_film'])) {
        $film = sanitize_text_field($_POST['new_film']);
        $wpdb->insert($table_name, ['film' => $film]);
    }

    // Ajouter une horaire
    if (isset($_POST['new_showtime']) && isset($_POST['actual-film'])) {
        $showtime = sanitize_text_field($_POST['new_showtime']);
        $film = htmlspecialchars($_POST['actual-film']);
        $wpdb->insert($table_name, ['showtime' => $showtime, 'film' => $film]);
    }

    // Supprimer une ligne d'horaires
    if (isset($_GET['delete_film'])) {
        $showtime = sanitize_text_field($_GET['delete_film']);
        $query = $wpdb->prepare("DELETE FROM $table_name WHERE film = %s", $showtime);
        $wpdb->query($query);
        
        $redirect_url = admin_url('admin.php?page=showtime-list');
        echo '<a id="redirectLink" href="' . esc_url($redirect_url) . '"></a>';
        echo '<script>document.getElementById("redirectLink").click();</script>';
    }
    

    // Récupérer toutes les tâches
    $stmt = $wpdb->get_results("SELECT * FROM $table_name ORDER BY 'film'");

    $showtimes = [];

    foreach ( $stmt as $row ) {
        $film = $row->film;
        $horaire = $row->showtime;
        
        if ( ! isset( $resultats[ $film ] ) ) {
            $resultats[ $film ] = array();
        }
        
        $showtimes[ $film ][] = $horaire;
    }

    ?>
    <div class="wrap">
        <h1>Ajout d'horaires</h1>
        <ul>
            <?php foreach ($showtimes as $index => $showtime) : ?>
                <li>
                    <form method="post">
                        <input type="text" name="actual-film" value="<?php echo htmlspecialchars($index); ?>" readonly>
                        <?php foreach ($showtime as $horaire) : if($horaire) : ?>
                            <input type="text" name="actual-showtime" value="<?php echo htmlspecialchars($horaire); ?>" readonly>
                        <?php endif; endforeach; ?>
                        <input type="text" name="new_showtime">
                        <input type="submit" value="Ajouter une horaire" class="button-primary">
                        <a href="?page=showtime-list&delete_film=<?php echo $index; ?>">
                            <input type="button" value="Supprimer la diffusion" class="button-primary">
                        </a>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post">
            <input type="text" name="new_film">
            <input type="submit" value="Ajouter un film" class="button-primary">
        </form>
    </div>
    <?php
}