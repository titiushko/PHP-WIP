<?php

  /*****************************************************
  ** Title........: Form Mail Script Language File
  ** Filename.....: language.fr.inc.php (French/Fran�ais)
  ** Author.......: Christine Coutaud
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: mailto:info@stadtaus.com
  ** ATTENTION....: Tous les changements � effectuer sur
  **                cette traduction doivent tenir compte
  **                des carat�res sp�ciaux fran�ais,
  **                notamment l'apostrophe. Vous devez
  **                OBLIGATOIREMENT utiliser \ (touches
  **                alt Gr +8) pour l'apostrophe! En
  **                effet, le langage PHP utilise le
  **                signe ' pour coder les instructions.
  *****************************************************/


  $txt = array (


                   'txt_attachment'                   => 'Attachment',
                   'txt_content_direction'            => 'ltr',
                   'txt_charset'                      => 'iso-8859-1',
                   'txt_cannot_lock_file'             => 'Impossible de verrouiller le fichier: ',
                   'txt_cannot_open_file'             => 'Impossible d\'ouvrir le fichier: ',
                   'txt_captcha_note'                 => 'To prevent automated Bots from form spamming, please enter the text you see in the image below in the appropriate input box. Your comment will only be submitted if the strings match. Please ensure that your browser supports and accepts cookies, or your comment cannot be verified correctly.',
                   'txt_captcha_try_again'            => 'You did not enter the correct text displayed in the spam-prevention image box. Please look at the image and enter the values displayed there.',
                   'txt_comment'                      => 'Commentaires',
                   'txt_compare_and'                  => ' and ',
                   'txt_confirm_email'                => 'Confirm E-mail',
                   'txt_email'                        => 'E-mail',
                   'txt_email_syntax'                 => 'Veuillez v�rifier l\'adresse email dans les champs suivants:',
                   'txt_empty_referrer'               => 'Referrer vide (site r�f�rant). Pour des raisons de s�curit�, ce formulaire ne peut �tre utilis� que si la page d\'appel provient du site mentionn�. Un r�f�rant vide peut �tre caus� par la configuration du navigateur, d\'un pare-feu  ou autre programme qui cache le site r�ferrant. D�sol�.',
                   'txt_error_captcha'                => 'Captcha image could not be generated.',
                   'txt_error_compare'                => 'Please make sure the following fields contain the same values:',
                   'txt_error_user_agent'             => 'User Agent error.',
                   'txt_fill_in'                      => 'Veuillez compl�ter les champs suivants:',
                   'txt_firstname'                    => 'Pr�nom',
                   'txt_form_not_submitted'           => 'The form could not be submitted.',
                   'txt_ip_address_expiration'        => 'Vous avez atteint le nombre maximum d\'emails que vous pouvez envoyer depuis la m�me adresse IP. C\'est une option de s�curit� pour �viter les abus d\'envoi de mails. Vous pourrez utiliser � nouveau le formulaire, apr�s votre prochaine connexion Internet.',
                   'txt_lastname'                     => 'Nom',
                   'txt_mandatory_fields'             => 'Champs obligatoires',
                   'txt_no'                           => 'Non',
                   'txt_password'                     => 'Password',
                   'txt_confirm_password'             => 'Confirm Password',
                   'txt_popen_error'                  => 'Fonction popen() erreur.',
                   'txt_preview'                      => 'Visualiser',
                   'txt_problems'                     => '<p><strong>Quelques probl�mes?</strong> Documentation et instructions du script: <a href="./docu/index.html" target="_blank">./docu/index.html</a></p><p>Des r�ponses � vos questions sur le  <a href="http://www.stadtaus.com/forum/" target="_blank">forum du support</a> du site <a href="http://www.stadtaus.com/en/" target="_blank">Form Mail Script</a>.</p>',
                   'txt_receive_information'          => 'Obtenir plus d\'information?',
                   'txt_required_lastname'            => 'Veuillez saisir votre nom.',
                   'txt_required_email'               => 'Veuillez saisir votre e-mail.',
                   'txt_required_subject'             => 'Veuillez saisir un sujet.',
                   'txt_syntax_email'                 => 'Le format e-mail est incorrect. Veuillez saisir une adresse e-mail valable.',
                   'txt_salutation'                   => 'Salutations',
                   'txt_script_name'                  => 'Form Mail Script',
                   'txt_set_off_note'                 => '<b>Note:</b> Apr�s avoir configur� le script, vous devriez d�sactiver ce syst�me de messages en inscrivant OFF sur la LIGNE DE VARIABLE $show_error_messages dans le ficher de configuration INDEX.PHP.',
                   'txt_subject'                      => 'Sujet',
                   'txt_submit'                       => 'Soumettre',
                   'txt_subscribe_newsletter'         => 'S\'inscrire � la lettre d\'information?',
                   'txt_system_message'               => 'Message syst�me ',
                   'txt_thank_you'                    => 'Merci! Votre email est en cours d\'envoi.',
                   'txt_vote'                         => 'Vous aimez Form Mail Script?',
                   'txt_wrong_html_template'          => 'Le mod�le HTML d�fini dans le fichier de configuration INDEX.PHP (<i>$file[\'default_html\']</i>) ou &lt;input type=&quot;hidden&quot; name=&quot;html_template&quot; value=&quot;&quot; /&gt; n\'existe pas. Veuillez v�rifier le nom du fichier et son emplacement dans le r�pertoire mentionn�.',
                   'txt_wrong_ip_address'             => 'L\'adresse IP que vous utilisez actuellement est inscrite dans la liste des IP bannies. Vous n\'�tes donc pas autoris�(e) � utiliser ce formulaire.',
                   'txt_wrong_mail_template'          => 'Le mod�le d\'email d�fini dans le fichier de configuration INDEX.PHP (<i>$file[\'default_html\']</i>) ou &lt;input type=&quot;hidden&quot; name=&quot;mail_template&quot; value=&quot;&quot; /&gt; n\'existe pas. Veuillez v�rifier le nom du fichier et son emplacement dans le r�pertoire mentionn�.',
                   'txt_wrong_referrer'               => 'Mauvais referrer (site r�f�rant). Pour des raisons de s�curit�, ce formulaire ne peut �tre utilis� que si la page d\'appel fait partie de ce site.',
                   'txt_wrong_referrer_admin'         => '<br /><br />Note pour l\'adminsitrateur: Veuillez ajouter le nom de serveur � la variable REFERRER dans le fichier de configuration index.php: ',
                   'txt_wrong_template_path'          => 'Le chemin d\'acc�s au r�pertoire TEMPLATE est incorrect. Veuillez entrer le chemin complet et correct sur la ligne de variable <i>$path[\'templates\']</i> dans le fichier de configuration INDEX.PHP',
                   'txt_yes'                          => 'Oui',
                   'txt_your_data'                    => 'R�capitulatif des informations � soumettre.'



               );



?>