<?php require_once("../includes/braintree_init.php"); ?>

<html>
<?php require_once("../includes/head.php"); ?>
<body>

    <?php require_once("../includes/header.php"); ?>

    <div class="wrapper">
        <div class="checkout container">

            <header>
                <h1>Hi, <br>Let's make a transaction</h1>
                <p>
                    Make a payment with Braintree using PayPal or a card
                </p>
            </header>

            <form method="post" id="payment-form" action="/checkout.php">
                <section>
                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>

                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount">
                        </div>
                    </label>

                    <label for="firstName" style="border-top: 0;">
                        <span class="input-label">First Name</span>
                        <div class="input-wrapper">
                            <input id="firstName" name="firstName" type="text" placeholder="First Name">
                        </div>
                    </label>

                    <label for="lastName" style="border-top: 0;">
                        <span class="input-label">Last Name</span>
                        <div class="input-wrapper">
                            <input id="lastName" name="lastName" type="text" placeholder="Last Name">
                        </div>
                    </label>

                    <label for="settlement" style="border-top: 0;">
                        <span class="input-label">Settlement</span>
                        <div class="input-wrapper">
                            <p>Settlement</p>
                            <input type="checkbox" name="settlement" value="1" style="width: auto;">
                        </div>
                    </label>
                </section>

                <button class="button" type="submit"><span>Make Transaction</span></button>
            </form>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/js/braintree-2.27.0.min.js"></script>
    <script>
        var checkout = new Demo({
            formID: 'payment-form'
        })
        var client_token = "<?php echo(Braintree\ClientToken::generate()); ?>";
        braintree.setup(client_token, "dropin", {
            container: "bt-dropin"
        });
    </script>
</body>
</html>
