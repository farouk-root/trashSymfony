<?php

namespace App\Controller;

use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;




class HomeController extends AbstractController
{

    private $manager;

    private $gateway;


    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager=$manager;

        $this->gateway= new StripeClient($_ENV['STRIPE_SECRETKEY']);
    }



    //Page d'accueil / Ma Cart
    #[Route('/', name: 'app_cart')]
    public function index(): Response
    {
        return $this->render('cart/cart.html.twig');
    }

    #[Route('/checkout', name: 'app_checkout', methods:"POST")]
    public function checkout(Request $request): Response
    {
        $amount=$request->request->get('amount');

        $amount = 523;

        $quantity=$request->request->get('quantity');


        //créer le checkout

        $checkout=$this->gateway->checkout->sessions->create(
            [
                'line_items'=>[[
                    'price_data'=>[
                        'currency'=>$_ENV['STRIPE_CURRENCY'],
                        'product_data'=>[
                            'name'=>'Nike',
                        ],

                        'unit_amount'=>intval($amount),

                    ],
                    'quantity'=>$quantity
                ]],

                'mode'=>'payment',
                'success_url'=>'http://127.0.0.1:8000/contribution',
                'cancel_url'=>'http://127.0.0.1:8000/cancel?id_sessions={CHECKOUT_SESSION_ID}'
            ]);

        return $this->redirect($checkout->url);




    }


    #[Route('/success', name: 'app_success')]
    public function success(Request $request): Response
    {
        //$id_sessions=$request->query->get('id_sessions');


        //Récupère le customer via l'id de la  session
       /* $customer=$this->gateway->checkout->sessions->retrieve(
            $id_sessions,
            []
        );
*/
        //Récupérer les informations du customer et de la transaction

        //$name=$customer["customer_details"]["name"];

        //$email=$customer["customer_details"]["email"];

       // $payment_status=$customer["payment_status"];

        //$amount=$customer['amount_total'];



        //Stocker au niveau de la base de données



        //Email au customer




        //Message de succès


        return $this->redirectToRoute('app_contribution_index', [], Response::HTTP_SEE_OTHER);

    }


    #[Route('/cancel', name: 'app_cancel')]
    public function cancel(Request $request): Response
    {
        dd("cancel");
    }

}