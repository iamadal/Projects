<?php

/**
 * @author Adal Khan <https://www.github.com/iamadal>
 * The App Kernel 
 * */
namespace Components\Base;

use Components\Base\Database;
use Components\Models\SysAdmin;
use Components\Models\User;
use Components\Models\Bill;
use Dompdf\Dompdf;
use Dompdf\Options;

ob_start();

$_SESSION['notice'] = 'বিলের তালিকা অর্থ বছর ২০২৪-২৫';

class app {
    private static $View;
    
    public static function init() {
        if (self::$View === null) {
            self::$View = new \Twig\Environment(new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../Views'));
        }
    }
    public static function login(){
       $_SESSION['username_error']=null;
       $_SESSION['password_error']=null;
       if(isset($_SESSION['user'])){
          header('location: /info');
          exit();
        } else {
          self::init();
          $csrf_token = Web::generateCsrfToken();
          echo self::$View->render('index.cs_',["csrf_token"=>$csrf_token]);
        }
    }
    public static function login_submit(){
         if(isset($_SESSION['user'])){
            header('location: /info');
            exit();
        } else {
          $username = trim(Web::sanitize($_POST['user_id']));
          $password = trim(Web::sanitize($_POST['password']));
          $db       = new User();   
          $usr      = $db->auth($username,$password); 
          $role     = $db->findUser($username);
        if($usr){
            $_SESSION['user']             = $role['username'];
            $_SESSION['role']             = $role['role_name'];
            $_SESSION['role_designation'] = $role['role_designation'];
            switch($role['role_name']){
                
                case 'director_general':
                header('location: /director_general');
                exit();
                break;
                
                case 'director_admin':
                header('location: /director_admin');
                exit();
                break;

                case 'ad_admin':
                header('location: /ad_admin');
                exit();
                break;
                
                case 'canteen_manager':
                header('location: /canteen_manager');
                exit();
                break;

                case 'admin_officer':
                header('location: /admin_officer');
                exit();
                break;

                case 'computer_operator':
                header('location: /computer_operator');
                exit();
                break;

                case 'cashier':
                header('location: /cashier');
                exit();
                break;

                default:
                header('location: /info');
                exit();
                break;
            }
        
        } else {
            $_SESSION['username_err'] = "আপনি ভুল পাসওয়ার্ড অথবা ইউজার আইডি দিয়ে চেষ্টা করছেন";
            header('location: /');
            exit();
        }
      }
    }
    public static function create_user(){
        self::init();
        $csrf_token = Web::generateCsrfToken();

        echo self::$View->render('create_user.cs_',[
            "csrf_token"=>$csrf_token,
            "username_error"=>$_SESSION['username_error'],
            "password_error"=>$_SESSION['password_error']
        ]);     
    }
    public static function create_user_submit() {
        $username      = trim(Web::sanitize($_POST['username']));
        $pass1         = trim(Web::sanitize($_POST['pass1']));
        $pass2         = trim(Web::sanitize($_POST['pass2']));
        $first_name    = trim(Web::sanitize($_POST['first_name']));
        $last_name     = trim(Web::sanitize($_POST['last_name']));
        $phone         = trim(Web::sanitize($_POST['phone']));
        $img_url       = "unset";

        $db = new User();
        $re = $db->findUser($username);
        if(!$re){
            if( ($pass1 !==$pass2) || strlen($pass1)<8 || strlen($pass2)<8 ){
               $_SESSION['password_error']="দুঃখিত, পাসওয়ার্ড মিল নেই। 8 ডিজিটের চেয়ে বড় পাসওয়ার্ড দিন।";
                header('location: /create_user');
                exit();
            } else {
               $db->create($username,$pass1,$first_name,$last_name,$phone,$img_url);
                header('location: /');
                exit();
            }
        } else {
           $_SESSION["username_error"] = "দুঃখিত, আপনার দেওয়া ইউজারনেমটি নিবন্ধিত আছে। অনুগ্রহ করে অন্য একটি নাম চেষ্টা করুন।";
           header('location: /create_user');
           exit();
        }
    }
    public static function update_user(){
        if(isset($_SESSION['user'])){
             self::init();
            $csrf_token = Web::generateCsrfToken();
            echo self::$View->render('update_user.cs_',[
                "csrf_token"=>$csrf_token,
                "user" => $_SESSION['user']
            ]);
        } else {
            header('location: /');
            exit();
        }
       
    }
    public static function update_user_submit(){
        $user       = trim(Web::sanitize($_POST['username']));
        $first_name = trim(Web::sanitize($_POST['first_name']));
        $last_name  = trim(Web::sanitize($_POST['last_name']));
        $phone      = trim(Web::sanitize($_POST['phone']));
        $db         = new User();
        $res        = $db->update($user,$first_name,$last_name,$phone); 
        header('location: /');
        exit();
    }
    public static function info(){
        if(!isset($_SESSION['user'])){
            header('location: /');
            exit();
        } else {
           $db   = new User();     
           if($data = $db->findUser($_SESSION['user'])){
             self::init();
             echo self::$View->render('info.cs_',[
              "user"=>$_SESSION['user'],
              "first_name" => $data['first_name'],
              "last_name" => $data['last_name'],
              "phone" => $data['phone'],
              "role_designation"=> $data['role_designation'],
              "role_name"=>$data['role_name'],
              "dashboard"=>$data['role_name'],
              "username"=>$data['username'],
              "csrf_token"=>Web::generateCsrfToken()
        ]);
          } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
          }
        }
    }
    public static function SysAdmin(){
        $_SESSION['username_error']=null;
        if(isset($_SESSION['username'])=="__admin"){
            header('location: /admin');
            exit();
        }else {
          self::init();
          echo self::$View->render('sysadmin.cs_',["csrf_token"=>Web::generateCsrfToken()]);    
        }   
    }
    public static function SysAdminLogin(){
        if(isset($_SESSION['username'])=="__admin"){
            header('location: /admin');
            exit();
        } else {
          $username = trim(Web::sanitize($_POST['username']));
          $password = trim(Web::sanitize($_POST['pass']));
          $db       = new SysAdmin();   
          $admin    = $db->auth($username,$password); 
          if($admin){
            $_SESSION['username'] = $admin['username'];
            $_SESSION['app_mode'] = $admin['app_mode'];
            header('location: /admin');
            exit();
         } else {
            return "Invalid Info";
          }
        }
    }
    public static function admin(){
        if( isset($_SESSION['username'])=="__admin"){
          self::init();
          $users = new User();
          $data  = $users->all();      
          echo self::$View->render('admin.cs_',["admin"=>$_SESSION['username'],"users"=>$data]);
        } else {
            header('location: /sysadmin');
            exit();
        }
    }
   public static function delete_user(){
      $username = trim(Web::sanitize($_GET['username']));
      if(isset($_SESSION['username'])=="___admin"){
          $img = 'img/users' . '/' . $_GET['username'] . '.png';
          $db  = new User();
          $res = $db->deleteUser($username);
         if(file_exists($img)){unlink($img);}
             header('location: /admin');
             exit();
       } else {
         header('location: /admin');
         exit();
      }
   }
   public static function admin_update(){
    if(isset($_SESSION['username'])=="__admin"){
          self::init();

         if(isset($_GET['action'])){
            $get_user = $_GET['action'];
         } else {
            $get_user = "";
         }
          echo self::$View->render('admin_update.cs_',["csrf_token"=>Web::generateCsrfToken(),"username_error"=>$_SESSION['username_error'],"username"=>$get_user]);
    } else {
     header('location: /sysadmin');
     exit();
   }
}
    public static function admin_update_submit(){
    $username = trim(Web::sanitize($_POST['username']));
    $role     = trim(Web::sanitize($_POST['role']));
    $role_d   = trim(Web::sanitize($_POST['role_designation']));
    $status   = trim(Web::sanitize($_POST['status']));
    $user     = new User();
    $data     = $user->findUser($username);
    if($data){
        $user->update_role($username,$role,$role_d,$status);
        header('location: /admin');
        exit();
    } else {
      $_SESSION['username_error'] = "এই নামে কোন ইউজার নেই।";
      header('location: /admin_update');
      exit();
    }
       
   }
    public static function director_general(){    
        if($_SESSION['role'] == "director_general"){
                self::init();
           echo self::$View->render('director_general.cs_');
        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }
    }
    public static function director_admin(){
       if($_SESSION['role'] == "director_admin"){
                self::init();
           echo self::$View->render('director_admin.cs_');
        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }
    }

//--------------------------------------------------------------------------------------------------------------------------------------
    public static function ad_admin(){
       if($_SESSION['role'] == "ad_admin"){
                $db    = new User();
                $bill  = new Bill();
                $data  = $db->findUser($_SESSION['user']); 
                $bdata = $bill->all_bill();
                $total_amount = 0;
                $due_amount   = 0;
                $bill_gen = '';
                


                foreach ($bdata as $row) {
                     $total_amount += $row['total_amount']; 
                }


                $ddata = $bill->due_amount();
                $due_amount = 0;

                foreach ($ddata as $row) {
                     $due_amount += $row['due_amount']; 
                }



                $pdata = $bill->paid();
                $paid_amount = 0;

                foreach ($pdata as $row) {
                     $paid_amount += $row['paid_amount']; 
                }

                $wdata = $bill->pending();
                $pending_amount = 0;

                foreach ($wdata as $row) {
                     $pending_amount += $row['total_amount']; 
                }


                $fl_date = $bill->start_end_date();

                self::init();
           echo self::$View->render('ad_admin.cs_',[
                        "first_name"=>$data['first_name'],
                        "last_name"=>$data['last_name'],
                        "role_name"=>$data['role_designation'],
                        "all_bill" => count($bdata),
                        "total_amount" => number_format($total_amount),
                        "all_due" => count($ddata),
                        "due_amount"=> number_format($due_amount),
                        "all_paid"=> count($pdata),
                        "paid_amount" => number_format($paid_amount),
                        "all_pending" => count($wdata),
                        "pending_amount"=>number_format($pending_amount),
                        "first_bill"=>$fl_date['first_bill_date'],
                        "last_bill" =>$fl_date['last_bill_date']
        ]);
        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }
    }


    //--------------------------------------------------------------------------- AD Admin ----------------------------------------------------------


    // Reprot
public static function report() {
    // Check if required GET parameters are set
    if (isset($_GET['start_date'], $_GET['end_date'], $_GET['options'])) {
        $bill = new Bill();
        $bill_report = [];
        $bill_gen = '';

        // Switch based on the options provided
        switch ($_GET['options']) {
            case 'pending':
                $bill_report = $bill->bill_report_pending($_GET['start_date'], $_GET['end_date']);
                $bill_gen = "অপেক্ষমান বিলের তালিকা";
                break;

            case 'due':
                $bill_report = $bill->bill_report_due($_GET['start_date'], $_GET['end_date']);
                $bill_gen = "বকেয়া বিলের তালিকা";
                break;

            case 'paid':
                $bill_report = $bill->bill_report_paid($_GET['start_date'], $_GET['end_date']);
                $bill_gen = "পরিশোধিত বিলের তালিকা";
                break;

            default:
                $bill_report = $bill->bill_report_all($_GET['start_date'], $_GET['end_date']);
                $bill_gen = "সকল বিল তালিকা";
                break;
        }        

        // Check if the bill report is not empty
        if (!empty($bill_report)) {
            self::init();
            echo self::$View->render('report.cs_', [
                'bill_report' => $bill_report,
                'bill_gen' => $bill_gen,
                'user' => $_SESSION['user']
            ]);
        } else {
           echo "<p>No Data Found! Please Click Back Button in your Browser</p>";
        }
    } else {
        // Handle missing parameters
        echo "Please provide start date, end date, and options.";
    }
}


//------------------------------------------------------------------------------------------------------------------------------------------
    public static function canteen_manager(){
        if($_SESSION['role'] == "canteen_manager"){
                $bills = new Bill();
                $bdata = $bills->all_co();
                $db    = new User();
                $data  = $db->findUser($_SESSION['user']); 

                   if(isset($_GET['delete'])){
                 $bills = new Bill();
                 $bills->delete_bill(Web::sanitize($_GET['delete']));

                 $file = 'bill' . '/' . $_GET['delete'] . '.pdf';
                 if(file_exists($file)){unlink($file);}




                 header('location: /canteen_manager');
                 exit();
           }

            if(isset($_GET['forward'])){
                 $bills = new Bill();
                 $bills->forward_ao($_GET['forward'],'admin_officer');
                 header('location: /canteen_manager');
                 exit();
           }




                self::init();
           echo self::$View->render('canteen_manager.cs_',[
            "first_name"=>$data['first_name'],
            "last_name"=>$data['last_name'],
            "role_name"=>$data['role_designation'],"users"=>$bdata]);


        




        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }
    }
    public static function admin_officer(){
      if($_SESSION['role'] == "admin_officer"){
                self::init();
               
                $bills = new Bill();
                $bdata = $bills->all_ao();
                $db    = new User();
                $data  = $db->findUser($_SESSION['user']); 
                self::init();
                echo self::$View->render('admin_officer.cs_',[
               "first_name"=>$data['first_name'],
               "last_name" =>$data['last_name'],
               "role_name" =>$data['role_designation'],"users"=>$bdata]);


           if(isset($_GET['hall_rent']) && isset($_GET['bill_id'])){
               $bills        = new Bill();
               $hall_rent    = trim(Web::sanitize($_GET['hall_rent']));
               $food_bill    = $bills->findBill($_GET['bill_id']);
               $total_amount = $food_bill['food_bill']+$hall_rent;
               $due_amount   = $food_bill['due_amount']+$hall_rent;

               $bills->add_hall_rent($_GET['bill_id'],$hall_rent,$total_amount,$due_amount,$_SESSION['user']);
               header('location: /admin_officer');
               exit();

           }


           if(isset($_GET['backward'])){
               $bills = new Bill();
               $bills->forward_ao($_GET['backward'],'canteen_manager');
               header('location: /admin_officer');
               exit();
          }


       
        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }
    }
    public static function computer_operator(){
        $_SESSION['bill_created'] = "";
       if($_SESSION['role'] == "computer_operator"){
            $db        = new User();
            $bills     = new Bill();
            $data_bill = $bills->all_co();
            $data      = $db->findUser($_SESSION['user']); 


                               if(isset($_GET['del'])){
                 $bills = new Bill();
                 $bills->delete_bill(Web::sanitize($_GET['del']));

                 $file = 'bill' . '/' . $_GET['del'] . '.pdf';
                 if(file_exists($file)){unlink($file);}
                 header('location: /computer_operator');
                 exit();
             }





                self::init();
           echo self::$View->render('computer_operator.cs_',[
            "username"=>$_SESSION['user'],
            "first_name"=>$data['first_name'],
            "last_name"=>$data['last_name'],
            "role_name"=>$data['role_designation'],
            "csrf_token"=>Web::generateCsrfToken(),
            "submitted"=>$_SESSION['bill_created'],
            "users"=>$data_bill

        ]);






        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }
    }



    public static function create_bill(){


         if($_SESSION['role'] == "computer_operator"){

            $db = new bill();
            $data  = $db->findBill($_POST['bill_id']);
            if(!$data){
            $bill_id      = trim(Web::sanitize($_POST['bill_id']));
            $description  = trim(Web::sanitize($_POST['description']));
            $food_bill    = trim(Web::sanitize($_POST['food_bill']));
            $paid_amount  = trim(Web::sanitize($_POST['paid_amount']));
            $mr_no        = trim(Web::sanitize($_POST['mr_no']));
            $tag          = trim(Web::sanitize($_POST['tag']));
            $total_amount = $food_bill;
            $due_amount   = $food_bill-$paid_amount;
            $fw_status    = 'canteen_manager';
            $submitted_by = $_SESSION['user'];

            $db           = new Bill();
            
            $data = $db->create_bill($bill_id,$description,$food_bill,$total_amount,$paid_amount,$due_amount,$mr_no,$submitted_by,$tag,$fw_status);
             header('location: /computer_operator');
             exit();
            
            exit();
            }  else {
                header('location: /computer_operator');
                exit();

            }


        } else {
            session_unset();
            session_destroy();
            header('location: /');
            exit();
        }

    }






    public static function cashier() {
    $bdata = [];
    
    if ($_SESSION['role'] == "cashier") {
        self::init();
        $bills = new Bill();
        
        // Check if a search query is provided
        if (isset($_GET['search'])) {
            $searchQuery = trim(Web::sanitize($_GET['search']));
            $bdata = $bills->search($searchQuery); 
        } else {
            $bdata = $bills->due_bill();
        }

        $db = new User();
        $data = $db->findUser($_SESSION['user']);
        self::init();

    
        echo self::$View->render('cashier.cs_', [
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "role_name" => $data['role_designation'],
            "users" => $bdata, 
        ]);

     
        if (isset($_GET['bill_id']) && isset($_GET['mr_no']) && isset($_GET['payment'])) {
            $payment = trim(Web::sanitize($_GET['payment']));
            $mr_no = trim(Web::sanitize($_GET['mr_no']));
            
    
            $bdata = $bills->findBill($_GET['bill_id']);
            $total_amount = $bdata['total_amount'];
            $paid_amount = $bdata['paid_amount'];
            $due_amount = $total_amount - ($payment + $paid_amount);
            
            if ($due_amount >= 0) {
                $new_paid = $total_amount - $due_amount;
                $bills->receive_cash($_GET['bill_id'], $due_amount, $_SESSION['user'], $new_paid, $mr_no);
                header('location: /cashier');
                exit();
            } else {
                header('location: /cashier');
                exit();
            }
        }
    } else {
     
        session_unset();
        session_destroy();
        header('location: /');
        exit();
    }
}


   public static function findBill() {
                $total = 0;
                $food = 0;
                $hall = 0;
                $due = 0;
    if (isset($_SESSION['user'])) {
        $db = new User();
        $data = $db->findUser($_SESSION['user']);

        if ($data['user_status'] == 'active') {
            $result = '';

            if (isset($_GET['action'])) {
                $db = new Bill();
                $response = $_GET['action'];

                switch ($response) {
                    case 'all':
                        $result = $db->all();
                        break;

                    case 'hall':
                        $result = $db->hall();
                        break;

                    case 'food':
                        $result = $db->food();
                        break;

                    case 'paid':
                        $result = $db->paid();
                        break;

                    case 'due':
                        $result = $db->due_amount();
                        break;

                   case 'download':
                   $file_name = $_GET['download'];
$file_name = basename($file_name); // Sanitize input
$file = 'bill/' . $file_name . '.pdf'; // Ensure the file has a .pdf extension

if (file_exists($file)) {
    // Set headers to open the PDF in the browser
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename=" Bill ID:' . $_GET['download'] . '.pdf"');
    header('Content-Length: ' . filesize($file));

    // Read the file and output it
    readfile($file);
    exit;
} else {
    header('location: /' . $_SESSION['role']);
    exit();
}
   
         
    break;


                    default:
                        $result = $db->search($_GET['action']);
                        break;
                }
            }

            if (!empty($result)) {
                $c = $result;
                foreach($c as $row){
                    $total = $total + $row['total_amount'];
                    $food  = $food  + $row['food_bill'];
                    $hall  = $hall  + $row['hall_rent'];
                    $due   = $due   + $row['due_amount'];
                }
            } else {
                $c = [];
            }

            self::init();
            echo self::$View->render('bill_query.cs_', [
                "users" => $result,
                "notice" => $_SESSION['notice'],
                "search_item" => count($c),
                "first_name" => $data['first_name'],
                "last_name" => $data['last_name'],
                "role_designation" => $data['role_designation'],
                "total"=>$total,
                "hall"=>$hall,
                "food"=>$food,
                "due"=>$due
            ]);
        } else {
            echo "<p>This ID is not approved yet. Please contact the administrator. Thanks</p>";
        }
    } else {
        header('location: /');
        exit();
    }
}



// Fetch API

public static function read_data(){
    $data = 'This is a sample Test Response';
    header("Content-Type: application/json");
    $a = json_encode($data);
    return $a;
}






public static function about(){
    echo "Bill Management System for BIAM.<br>Copyright &copy; MD. ADAL KHAN - 2024 <br><br> 01. First Create your ID.<br> 02. Wait for the approval. <br> 03. Act according to your role assigned by the Admin<br><br>Developer: MD. ADAL KHAN <br>BSc(hons) Mathematics (1st class 1st), NU <br> MSc Mathematics(1st class 1st), NU. 
       <br>Area of Interest:CFD, Financial Software Development, Algorithm Design<br><br>" . '<a href="/">Back to Homepage</a>'  ;
}


public static function menu(){
    self::init();
    echo self::$View->render('menu.cs_');
}


public static function bill_verify(){
    self::init();
    $result = [];
    if(isset($_GET['bill_verify'])){
             $db = new Bill();
         $data = $db->findBill($_GET['bill_verify']); 
         $result = [$data];
    }
  
    echo self::$View->render('bill_verify.cs_',["users"=>$result]);
}







    public static function logout(){
        session_unset();
        session_destroy();
        header('Location: /');
        exit();
    }




}
