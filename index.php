<?php
    //Osztályok automatikus betöltése
    //Paraméterként az osztály neve
    function classLoader($className)
    {
        include 'class/'.$className.'.class.php';
    }

    //Saját osztály betöltő függvény regisztrálása az __autoload helyett
    spl_autoload_register('classLoader');

    session_start();

    //Biztonsági védelem - Session azonosító újra generálása
    session_regenerate_id();

    $GLOBALS['PDO'] = myPDO::getPDO();

    //Új felhasználó létrehozása ha még nem létezik
    if (!$_SESSION['user']) {
        new user();
    }

    //Kosár létrehozása ha még nem létezik
    if (!$_SESSION['cart']) {
        new cart();
    }

    //Rákattintott e felhasználó a bejelentkezés gombra
    if (isset($_POST['login'])) {
        $_SESSION['user']->userLogin();
    }

    //Kijelentkezés
    if (isset($_POST['logout'])) {
        $_SESSION['user']->userLogout();
    }

    //Kosárba a terméket
    if (isset($_POST['addToCart'])) {
        new item();
    }

    //Szállítási cím beállítása
    if (isset($_POST['deliveryAddress'])) {
        $_SESSION['deliveryAddress'] = $_POST['deliveryAddress'];
    }

    //Számlázási cím beállítása
    if (isset($_POST['billingAddress'])) {
        $_SESSION['billingAddress'] = $_POST['billingAddress'];
    }

    //Fizetési mód megadása
    if (isset($_POST['paymentMethod'])) {
        $_SESSION['paymentMethod'] = $_POST['paymentMethod'];
    }

    //Rendelés leadása
    if (isset($_POST['placeOrder'])) {
        $_SESSION['cart']['obj']->placeOrder();
    }

    $GLOBALS['page'] = new page();

    //Fejlesztés panel
    new dev();
?>
