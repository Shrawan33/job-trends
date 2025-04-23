# Payment gateway for multiple payment gateway customizable
Copy zip file to perception/libreries/payment

#Author email : 
digant@perceptionsystem.in
subash@perceptionsystem.in

# run composer dumpautoload
# setup your crediantials in env file as following 
CCAVENUE_MERCHANT_ID=
CCAVENUE_ACCESS_CODE=
CCAVENUE_WORKING_KEY=
CCAVENUE_REDIRECT_URL=payment/callback
CCAVENUE_CANCEL_URL=payment/callback
CCAVENUE_CURRENCY=INR
CCAVENUE_LANGUAGE=EN
CCAVENUE_TEST_MODE=true
# to use facade and alias: 
add folowing class in config/app.php
in providers list:
\Perception\Libraries\Payment\PaymentServiceProvider::class,
in alias list
 'PaymentFacade' => \Perception\Libraries\Payment\Facades\PaymentFacade::class,
# run following commands 
php artisan cache:clear , 
php artisan :config:clear

# publish the vendor files:
Run php artisan vendor:publish and find perception/libraries/payment and hit enter. 

You can customize payment.php inside config folder to customize and wish to add any other payment methods. 

# To add other India's payment gateways, you can just create a gateway class inside the gateway folder of package, and set the gateway name from config.php to get another payment gateay, and it's environment variables. 


#to prepare and get encrypted auth key from Ccavenue
Using facade class, 

PaymentFacade::paynow($paraneters);
 
 Then the transaction process will be started. 

 TO catch the response. you can set your own callback route
 on the POST method, The response will give all the details you wish to get from Ccavenue
 Catch response in controller example: 
 $response = PaymentFacade::response($request->all);

# Happy coding :) 


