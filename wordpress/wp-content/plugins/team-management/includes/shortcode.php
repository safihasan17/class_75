<?php
function team_members_shortcode()
{
    global $wpdb;
    $table = $wpdb->prefix . 'team_members';
    $results = $wpdb->get_results("SELECT * FROM $table");
    // echo "<pre>";
    // print_r($results);
    // echo "</pre>";
    ob_start();
?>
    <style>
        .container {
            width: min(1200px, 90%);
            margin: auto;
        }

        .team-section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #666;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .team-card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .team-card:hover {
            transform: translateY(-8px);
        }

        .team-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .team-card h3 {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .team-card span {
            display: block;
            color: #0d6efd;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .team-card p {
            color: #2f2f2f;
            line-height: 1.6;
            padding: 8px 10px;
            background-color: rgba(0, 0, 0, .08);
            border-radius: 8px;
        }
    </style>
    <section class='team-section'>
        <div class='container'>

            <div class='section-title'>
                <h2>Meet Our Team</h2>
                <p>The people behind our success.</p>
            </div>

            <div class='team-grid'>
                <?php foreach ($results as $item) { ?>
                <div class='team-card'>
                    <?php if ($item->image != null) {
                        $img = wp_get_attachment_url($item->image);
                    } else {
                        $img = "https://placehold.co/120x120/000000/FFFFFF.png?text=".$item->name;
                    } ?>
                    <img src='<?php echo $img; ?>' alt='John Doe'>
                    <h3><?php echo $item->name; ?></h3>
                    <span><?php echo $item->designation; ?></span>
                    <p><?php echo $item->email; ?></p>
                </div>
                <?php } ?>
            </div>

        </div>
    </section>
<?php
    return ob_get_clean();
}
add_shortcode('team_members_section', 'team_members_shortcode');
?>