<?php
// Clé secrète pour le chiffrement/déchiffrement
$key = "MaCleSecrete123";

// Fonction pour crypter les données
function encrypt($data, $key) {
    // Générer un vecteur d'initialisation (IV)
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    
    // Chiffrer les données avec AES-256-CBC et la clé secrète
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    
    // Retourner le vecteur d'initialisation (IV) concaténé avec les données chiffrées
    return base64_encode($iv . $encrypted);
}

// Fonction pour décrypter les données
function decrypt($data, $key) {
    // Décoder les données cryptées en base64
    $data = base64_decode($data);
    
    // Extraire le vecteur d'initialisation (IV) de la donnée cryptée
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $iv_length);
    $data = substr($data, $iv_length);
    
    // Déchiffrer les données avec AES-256-CBC et la clé secrète
    return openssl_decrypt($data, 'aes-256-cbc', $key, 0, $iv);
}

// Exemple d'utilisation
$data = "Données sensibles à crypter";
$encrypted_data = encrypt($data, $key);
echo "Données cryptées : $encrypted_data <br>";

$decrypted_data = decrypt($encrypted_data, $key);
echo "Données décryptées : $decrypted_data <br>";
?>
