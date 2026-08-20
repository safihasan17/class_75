<?php 
function team_management_menu()
{
    add_menu_page(
        "Team Management List",     // page title
        "TeamManagement",                     // menu title
        "manage_options",           // capability
        "team-list",                // menu slug
        "team_members_list",                     // callback function
        "dashicons-groups",    // icon
        "30"                        // position
    );
    add_submenu_page(
        "team-list",                // parent slug
        "Add Team Member",                 // page title
        "Add Member",                      // menu title
        "manage_options",           // capability
        "team-add",                 // menu slug
        "team_management_add"                      // callback function
    );

    add_submenu_page(
        "",                // parent slug
        "Edit Team Member",                 // page title
        "Edit Member",                      // menu title
        "manage_options",           // capability
        "team-edit",                 // menu slug
        "team_management_edit"                      // callback function
    );
}

add_action('admin_menu', 'team_management_menu');
?>