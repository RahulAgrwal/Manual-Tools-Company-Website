<?php
/**
 * Template for the secrets file. Do NOT put real values in this file.
 *
 * Production (Hostinger): copy to  domains/manualtoolsco.com/config/secrets.php
 *                         (the folder NEXT TO public_html, not inside it)
 * Local development:      copy to  config/secrets.php  in the project root (git-ignored)
 */
return [
    // Gmail SMTP (use a Google App Password, not the account password)
    'smtp_user'        => 'manualtoolsco.dhn@gmail.com',
    'smtp_pass'        => '',

    // reCAPTCHA v3 secret key (the public site key stays in contact.php / sidebar-quote-form.php)
    'recaptcha_secret' => '',

    // MySQL for the visitor counter. On Hostinger use 'localhost'.
    'db_host'          => 'localhost',
    'db_port'          => 3306,
    'db_user'          => '',
    'db_pass'          => '',
    'db_name'          => '',
];
