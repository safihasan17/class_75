<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Central definition for every module. The generic CRUD engine
 * (inc/crud-engine.php) reads this to build List/Add/Edit pages
 * without repeating code per module.
 *
 * field types supported: text | textarea | date | select |
 *                         select_department | select_designation
 */
function hrml_get_modules() {
    return array(

        'department' => array(
            'table'        => 'hr_departments',
            'singular'     => 'Department',
            'plural'       => 'Departments',
            'menu_slug'    => 'hr-departments',
            'fields'       => array(
                'name'        => array( 'label' => 'Department Name', 'type' => 'text', 'required' => true ),
                'description' => array( 'label' => 'Description',     'type' => 'textarea' ),
            ),
            'list_columns' => array( 'name', 'description' ),
        ),

        'designation' => array(
            'table'        => 'hr_designations',
            'singular'     => 'Designation',
            'plural'       => 'Designations',
            'menu_slug'    => 'hr-designations',
            'fields'       => array(
                'name'          => array( 'label' => 'Designation Name', 'type' => 'text', 'required' => true ),
                'department_id' => array( 'label' => 'Department',       'type' => 'select_department' ),
            ),
            'list_columns' => array( 'name', 'department_id' ),
        ),

        'employee' => array(
            'table'        => 'hr_employees',
            'singular'     => 'Employee',
            'plural'       => 'Employees',
            'menu_slug'    => 'hr-employees',
            'fields'       => array(
                'name'            => array( 'label' => 'Full Name',       'type' => 'text', 'required' => true ),
                'department_id'   => array( 'label' => 'Department',      'type' => 'select_department' ),
                'designation_id'  => array( 'label' => 'Designation',     'type' => 'select_designation' ),
                'email'           => array( 'label' => 'Email',           'type' => 'text' ),
                'phone'           => array( 'label' => 'Phone',           'type' => 'text' ),
                'joining_date'    => array( 'label' => 'Joining Date',    'type' => 'date' ),
                'employee_id_no'  => array( 'label' => 'Employee ID No.', 'type' => 'text' ),
                'status'          => array( 'label' => 'Status', 'type' => 'select', 'options' => array(
                    'active'   => 'Active',
                    'inactive' => 'Inactive',
                    'on_leave' => 'On Leave',
                ) ),
            ),
            'list_columns' => array( 'name', 'department_id', 'designation_id', 'status' ),
        ),

        'notice' => array(
            'table'        => 'hr_notices',
            'singular'     => 'Notice',
            'plural'       => 'Notices',
            'menu_slug'    => 'hr-notices',
            'fields'       => array(
                'title'       => array( 'label' => 'Title',   'type' => 'text', 'required' => true ),
                'content'     => array( 'label' => 'Details', 'type' => 'textarea' ),
                'priority'    => array( 'label' => 'Priority', 'type' => 'select', 'options' => array(
                    'normal' => 'Normal',
                    'urgent' => 'Urgent',
                ) ),
                'expiry_date' => array( 'label' => 'Expiry Date', 'type' => 'date' ),
            ),
            'list_columns' => array( 'title', 'priority', 'expiry_date' ),
        ),

        'holiday' => array(
            'table'        => 'hr_holidays',
            'singular'     => 'Holiday',
            'plural'       => 'Holidays',
            'menu_slug'    => 'hr-holidays',
            'fields'       => array(
                'name'         => array( 'label' => 'Holiday Name', 'type' => 'text', 'required' => true ),
                'holiday_date' => array( 'label' => 'Date',         'type' => 'date' ),
                'holiday_type' => array( 'label' => 'Type', 'type' => 'select', 'options' => array(
                    'government' => 'Government',
                    'company'    => 'Company',
                ) ),
            ),
            'list_columns' => array( 'name', 'holiday_date', 'holiday_type' ),
        ),
    );
}

function hrml_get_module( $key ) {
    $modules = hrml_get_modules();
    return isset( $modules[ $key ] ) ? $modules[ $key ] : null;
}
