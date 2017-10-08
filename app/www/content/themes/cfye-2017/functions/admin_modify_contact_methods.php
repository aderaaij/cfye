<?php
function modify_contact_methods($profile_fields) { 
    
        // Remove old fields
        unset($profile_fields['aim']);
        unset($profile_fields['yim']);
        unset($profile_fields['jabber']);
        unset($profile_fields['googleplus']);
        unset($profile_fields['twitter']);
        unset($profile_fields['facebook']);
        unset($profile_fields['url']);
        return $profile_fields;
    }
    add_filter('user_contactmethods', 'modify_contact_methods'); 