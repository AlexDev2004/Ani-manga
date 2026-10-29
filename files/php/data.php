<?php if (session_status() === PHP_SESSION_NONE) session_start();
$pdoAniManga = new PDO('mysql:host=localhost;dbname=ani_manga','root','');


if(isset($_SESSION['id'])){
    $idUtilisateur = $_SESSION['id'];
    try{
        $rIdExist=$pdoAniManga->prepare("SELECT c.id_compte FROM compte c WHERE c.id_compte = ?");
        $rIdExist->bindParam(1,$idUtilisateur,PDO::PARAM_INT);
        $rIdExist->execute();
        $idExist = $rIdExist->fetch(PDO::FETCH_ASSOC);

        if(empty($idExist)){ header('Location: deconnection.php'); exit; }
    }catch(EXCEPTION $error){die($error->get_message());}
}

function star($notes){
    switch(true){
        case $notes == 0: echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes <= 1.2 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes < 1.8 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><defs><clipPath id='half-star'><rect x='0' y='0' width='12' height='24'/></clipPath></defs><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'fill='currentColor'stroke='none'clip-path='url(#half-star)'/><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes <= 2.2 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes < 2.8 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><defs><clipPath id='half-star'><rect x='0' y='0' width='12' height='24'/></clipPath></defs><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'fill='currentColor'stroke='none'clip-path='url(#half-star)'/><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes <= 3.2 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes < 3.8 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><defs><clipPath id='half-star'><rect x='0' y='0' width='12' height='24'/></clipPath></defs><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'fill='currentColor'stroke='none'clip-path='url(#half-star)'/><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes <= 4.2 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes < 4.9 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><defs><clipPath id='half-star'><rect x='0' y='0' width='12' height='24'/></clipPath></defs><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'fill='currentColor'stroke='none'clip-path='url(#half-star)'/><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        case $notes >= 4.9 : echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='currentColor'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
        default: echo("
            <button type='submit' name='1'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='2'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='3'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='4'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            <button type='submit' name='5'><svg xmlns='http://www.w3.org/2000/svg'viewBox='0 0 24 24'fill='none'stroke='currentColor'stroke-width='2'stroke-linecap='round'stroke-linejoin='round'><path d='M12 2.5 15.05 8.68 21.87 9.67 16.94 14.48 18.1 21.27 12 18.06 5.9 21.27 7.06 14.48 2.13 9.67 8.95 8.68Z'/></svg></button>
            "); break;
    }
}

function createCardManga($manga , $lien , $genres , $themes){
    echo("<a class='card' href='{$lien}html/mangaInfo.php?id=$manga[id_manga]'>
        <img src='{$lien}img/$manga[image_manga]'>
        <div class='infosCard'>
            <h2>$manga[titre_manga]</h2>
            <p><strong>Classification : </strong> $manga[nom_classification]</p>
            <p><strong>Genres : </strong> ");
                $first = true; foreach ($genres as $genre) {
                    if(!$first) echo(' - ');
                    echo($genre['nom_genre']);
                    $first = false;
                }
            echo("</p>
            <p><strong>Thèmes : </strong> ");
                $first = true; foreach ($themes as $theme) {
                    if(!$first) echo(' - ');
                    echo($theme['nom_theme']);
                    $first = false;
                }
            echo("</p>");
            if($manga['tomes_vf_manga'] != null) echo("<p><strong>Tomes VF : </strong>$manga[tomes_vf_manga]");
            echo("<p><strong>Tomes VO : </strong>$manga[tomes_vo_manga]</p>
            <div class='flagStars'>");
                if($manga['tomes_vf_manga'] == null) {
                    switch($manga['nom_pays']){
                        case 'Japon': echo("<img class='flag' style='border: solid black 1px; border-radius: 3px' src='{$lien}svgFlag/jp.svg'>"); break;
                        case 'France': echo("<img class='flag' style='border: solid black 1px; border-radius: 3px' src='{$lien}svgFlag/fr.svg'>"); break;
                    }
                }else{echo("<img class='flag' style='border: solid black 1px; border-radius: 3px' src='{$lien}svgFlag/fr.svg'>");}
                echo("<div class='stars'>");star($manga['note']);echo("</div>
            </div>
        </div>
    </a>");
}

function createCardAnime($anime , $lien , $genres , $themes){
    echo("<a class='card' href='{$lien}html/animeInfo.php?id=$anime[id_anime]'>
        <img src='{$lien}img/$anime[image_anime]'>
        <div class='infosCard'>
            <h2>$anime[titre_anime]</h2>
            <p><strong>Classification : </strong> $anime[nom_classification]</p>
            <p><strong>Genres : </strong> ");
                $first = true; foreach ($genres as $genre) {
                    if(!$first) echo(' - ');
                    echo($genre['nom_genre']);
                    $first = false;
                }
            echo("</p>
            <p><strong>Thèmes : </strong> ");
                $first = true; foreach ($themes as $theme) {
                    if(!$first) echo(' - ');
                    echo($theme['nom_theme']);
                    $first = false;
                }
            echo("</p>
            <p><strong>Épisodes : </strong>$anime[episodes_anime]</p>");
            if($anime['saisons_anime'] > 1) echo("<p><strong>Saisons : </strong>$anime[saisons_anime]</p>");
            echo("<div class='stars'>");star($anime['note']);echo("</div>
        </div>
    </a>");
}?>