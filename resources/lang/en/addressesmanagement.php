<?php

return [

    // Titles
    'showing-all-addresses'     => 'Showing All Addresses',
    'addresses-menu-alt'        => 'Show Addresses Management Menu',
    'create-new-address'       => 'Create New Address',
    'show-deleted-addresses'    => 'Show Deleted Address',
    'editing-address'          => 'Editing Address :name',
    'showing-address'          => 'Showing Address :name',
    'showing-address-title'    => ':name\'s Information',

    // Flash Messages
    'createSuccess'   => 'Successfully created address!',
    'updateSuccess'   => 'Successfully updated address!',
    'deleteSuccess'   => 'Successfully deleted address!',

    // Show address Tab
    'viewProfile'            => 'View Profile',
    'editAddress'               => 'Edit address',
    'deleteAddress'             => 'Delete address',
    'addressesBackBtn'           => 'Back to addresses',
    'addressesPanelTitle'        => 'Address Information',

    'labelHouse'            => 'House Number',
    'labelStreet'            => 'Street',
    'labelQuarter'            => 'Quarter',
    'labelCity'            => 'City',
    'labelRegion'            => 'Region',
    'labelCountry'            => 'Country',
    'labelDescription'            => 'Description',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Access',
    'labelPermissions'       => 'Permissions:',
    'labelCreatedAt'         => 'Created At:',
    'labelUpdatedAt'         => 'Updated At:',
    'labelDeletedAt'         => 'Deleted on',

    'addressesDeletedPanelTitle' => 'Deleted Address Information',
    'addressesBackDelBtn'        => 'Back to Deleted Addresses',

    'successRestore'    => 'address successfully restored.',
    'successDestroy'    => 'address record successfully destroyed.',
    'errorAddressNotFound' => 'address not found.',

    'labelAddressLevel'  => 'Level',
    'labelAddressLevels' => 'Levels',

    'addresses-table' => [
        'caption'   => '{1} :addressescount Address Total|[2,*] :addressescount Total Addresses',
        'id'        => 'ID',
        'full'      => 'Full Address',
        'w3w'     => 'What3Word',
        'lat'     => 'Latitude ',
        'long'     => 'Longitute',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
    ],

    'buttons' => [
        'create-new'    => 'New address',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> address</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> address</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> address</span>',
        'back-to-addresses' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">addresses</span>',
        'back-to-address'  => 'Back  <span class="hidden-xs">to address</span>',
        'delete-address'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> address</span>',
        'edit-address'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> address</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New Address',
        'back-addresses'    => 'Back to addresses',
        'latlong-address'    => 'Latitude: :lat, Longitude: :lat',
        'submit-search' => 'Submit Addresses Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'houseRequire'          => 'House Number is required.',
        'houseNumeric'          => 'House Number is only number.',
        'streetRequire'         => 'Street Name is required.',
        'streetMax'             => 'Street Name maximum length is 255 characters.',
        'quarterRequire'        => 'Quarter Name is required.',
        'quarterMax'            => 'Quarter Name maximum length is 255 characters.',
        'cityRequire'           => 'City Name is required.',
        'cityMax'               => 'City Name maximum length is 255 characters.',
        'regionRequire'         => 'Region Name is required.',
        'regionMax'             => 'Region Name maximum length is 255 characters.',
        'countryRequire'        => 'Country Name is required.',
        'countryMax'            => 'Country Name maximum length is 255 characters.',
        'descriptionRequire'    => 'Location Description is required.',
        'descriptionMax'        => 'Location Description maximum length is 255 characters.',
        'w3wRequire'            => 'What3Word Address is required.',
        'w3wMax'                => 'What3Word Address maximum length is 255 characters.',
        'latRequire'            => 'Latitude is required.',
        'latMax'                => 'Latitude maximum length is 255 characters.',
        'longRequire'           => 'Longitude is required.',
        'longMax'               => 'Longitude maximum length is 255 characters.',
        'fullRequire'           => 'Full Address is required.',
        'fullMax'               => 'Full Address maximum length is 255 characters.',
        'activatedRequire'      => 'Activated is required.',

        'address-creation-success'  => 'Successfully created address!',
        'update-address-success'    => 'Successfully updated address!',
        'delete-success'         => 'Successfully deleted the address!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-address' => [
        'id'                => 'address ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">address </span>Email',
        'role'              => 'address Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'address Role',
        'labelAccessLevel'  => '<span class="hidden-xs">address</span> Access Level|<span class="hidden-xs">address</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-addresses-ph'   => 'Search addresses',
    ],

    'modals' => [
        'delete_address_message' => 'Are you sure you want to delete :address?',
    ],
];
