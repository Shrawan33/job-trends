<html>

<head>
    <title> Non-Seamless-kit</title>
</head>

<body>
    <center>
        <?php include 'Crypto.php' ?>
        <?php
        error_reporting(0);

        $merchant_data = '';
        $working_key = 'DD11163DCC6FA7FF519852BE12904D6A'; //Shared by CCAVENUES
        $access_code = 'AVSI03IG83AO21ISOA'; //Shared by CCAVENUES
        foreach ($_POST as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
        $encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.

        $environment = 'test'; // secure
        $url = "https://{$environment}.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
        ?>
        <form method="post" name="redirect" action="<?= $url; ?>">
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            ?>
        </form>
    </center>
    <script language='javascript'>
        document.redirect.submit();
    </script>
</body>

</html>
