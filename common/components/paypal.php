<?php
/**
 * File Paypal.php.
 *
 * @author Marcio Camello <marciocamello@outlook.com>
 * @see https://github.com/paypal/rest-api-sdk-php/blob/master/sample/
 * @see https://developer.paypal.com/webapps/developer/applications/accounts
 */

namespace common\components;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\base\Component;

use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\FundingInstrument;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;
use yii\helpers\Url;


class paypal extends Component
{

    public function payit($amountValue,$currency,$project,$description)
    {
        $apiContext = new ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                //'AagcVmUqt8lnGfD0wYREPlbnr73W8inoDCQ4NlbUXt_nj73nSPys9WXna-EYZjH4RfPF-J2vovMaxPAy',     // ClientID
                //'EDTu0s6aniuWzWJfyFTsLGXL8sqQWZUny-nFMX3KrnnnGgUnYVpRKhfE9izNI-t5hhsV0nFCT52kKmAu'      // ClientSecret

                'AXOEdS6jVPdPE3K72t8LRPJnlJX0BsmozCakXC75NyIQHwC5bywqifKAM-Z26rJBXBsm9I_cL7wNgQbP',
                'EDnZX9Aym_SBvJyd1mmD9Ak1miACbQH-64wCh4z2WoVoeDm7nz7lCoZs7C-J0mAtTV0wBh3laGqEG19P'

                // live version
                //'AdR0126xOc6UlLuQQCVZphLOZ5uUCa7SY04kTkhD5eKLQK3WWzglK2FMkOM0-fEXnwRroC3wc0ZzR5Vm',
                //'ED4UHshk78qV4BSUtvveXqQKcaac132RN9FJ1iyZCCH2e_Pz3dajeHhGHt285lO-iJo582CWMwfbmCZh'


            )
        );

// inside docker
        $baseUrl2 = $_SERVER['DOCUMENT_ROOT'].'/frontend/modules/fisher/views/project/log.php';


        $apiContext->setConfig([
            'mode'=>'sandbox',
            'http.ConnectionTimeout'=>30,
            'log.LogEnabled'=>true,
            'log.FileName'=>$baseUrl2,
            'log.LogLevel'=>'FINE',
            'validation.level'=>'log'
        ]);

//SAMPLE 3
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName('ASIAEBUY-X ITEMS')
    ->setCurrency($currency)
    ->setQuantity(1)
    ->setPrice($amountValue);


$itemList = new ItemList();
$itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.


// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency($currency)
    ->setTotal($amountValue);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
//$baseUrl = getBaseUrl();
$baseUrl = Url::to('@paypal');

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/transaction?success=true&project=".$project."")
    ->setCancelUrl("$baseUrl/transaction?success=false&project=".$project."");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));


// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method
$approvalUrl = $payment->getApprovalLink();

// ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

return $payment;

//END SAMPLE 3
    }
  
}