<?php
include('connect.php');
require_once 'livespace.php';

/*
 * -------------------------------------------------
 *
 *                      klasa Kontakty
 *
 * -------------------------------------------------
 */




class kontakty{
    public $firm2;
    public $Imie;
    public $Nazwisko;
    public $Oddzial;
    public $Dzial;
    public $Stanowisko;
    public $NrKomorkowy;
    public $NrStacjonarny;
    public $email;
    public $id;

    public function __construct($id ,string $Imie,string $Nazwisko,string $firm2,string $Oddzial,string $Dzial,string $Stanowisko,string $NrStacjonarny,string $NrKomorkowy,string $email)
    {
        $this->id = $id;
        $this->Imie = $Imie;
        $this->Nazwisko = $Nazwisko;
        $this->firm2 = $firm2;
        $this->Oddzial = $Oddzial;
        $this->Dzial = $Dzial;
        $this->Stanowisko = $Stanowisko;
        $this->NrStacjonarny = $NrStacjonarny;
        $this->NrKomorkowy = $NrKomorkowy;
        $this->email = $email;

    }

    public function SendToBase(){
        global $mysqli;
        $statement = $mysqli->prepare("INSERT glowna (Imie,Nazwisko,Firma,Oddzial,Dzial,Stanowisko,numerStacjonarny,numerKomorkowy,adresEmail) VALUES (?,?,?,?,?,?,?,?,?)");
        $statement->bind_param("sssssssss", $this->Imie, $this->Nazwisko, $this->firm2, $this->Oddzial, $this->Dzial, $this->Stanowisko, $this->NrStacjonarny, $this->NrKomorkowy, $this->email);
        $statement->execute();
        $statement->close();


    }
    public function UpdateBase(){
        global $mysqli;
        $statement = $mysqli->prepare("UPDATE glowna SET Imie='$this->Imie',Nazwisko='$this->Nazwisko',Firma='$this->firm2',Oddzial='$this->Oddzial',Dzial='$this->Dzial',Stanowisko='$this->Stanowisko',numerStacjonarny='$this->NrStacjonarny',numerKomorkowy='$this->NrKomorkowy',adresEmail='$this->email' WHERE ID = '$this->id' LIMIT 1 ");
        $statement->bind_param("sssssssssi", $this->Imie, $this->Nazwisko, $this->firm2, $this->Oddzial, $this->Dzial, $this->Stanowisko, $this->NrStacjonarny, $this->NrKomorkowy, $this->email,$this->id);
        $statement->execute();
        $statement->close();


    }
    public function RemoveKontakt(){
        global $mysqli;
        $statement = $mysqli->prepare("DELETE FROM glowna WHERE ID = ? LIMIT 1 ");
        $statement->bind_param("i", $this->id);
        $statement->execute();
        $statement->close();

    }

}


/*
 * -------------------------------------------------
 *
 *                      Dodawanie
 *
 * -------------------------------------------------
 */



class AddSlownikowa {
    public $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function SendFirmaToBase(){
        global $mysqli;
        $statement = $mysqli->prepare("INSERT firmy (Firma) VALUES (?)");
        $statement->bind_param("s", $this->name);
        $statement->execute();
        $statement->close();



    }

    public function SendDeparToBase(){
        global $mysqli;
        $statement = $mysqli->prepare("INSERT oddzialy (Oddzial) VALUES (?)");
        $statement->bind_param("s", $this->name);
        $statement->execute();
        $statement->close();


    }

    public function SendSecToBase(){
        global $mysqli;
        $statement = $mysqli->prepare("INSERT dzialy (Dzial) VALUES (?)");
        $statement->bind_param("s", $this->name);
        $statement->execute();
        $statement->close();

    }

    public function SendStToBase(){
        global $mysqli;
        $statement = $mysqli->prepare("INSERT stanowiska (stanowisko) VALUES (?)");
        $statement->bind_param("s", $this->name);
        $statement->execute();
        $statement->close();

    }
}
/*
 * -------------------------------------------------
 *
 *                    Usuwanie
 *
 * -------------------------------------------------
 */


class Remove{
    public $rekord;
    public function __construct(string $rekord)
    {
        $this->rekord = $rekord;
    }
    public function RemoveFirma(){
        global $mysqli;
        $statement = $mysqli->prepare("DELETE FROM firmy WHERE ID = ? LIMIT 1 ");
        $statement->bind_param("i", $this->rekord);
        $statement->execute();
        $statement->close();
    }
    public function RemoveOddzial(){
        global $mysqli;
        $statement = $mysqli->prepare("DELETE FROM oddzialy WHERE ID = ? LIMIT 1 ");
        $statement->bind_param("i", $this->rekord);
        $statement->execute();
        $statement->close();
    }
    public function RemoveDzial(){
        global $mysqli;
        $statement = $mysqli->prepare("DELETE FROM dzialy WHERE ID = ? LIMIT 1 ");
        $statement->bind_param("i", $this->rekord);
        $statement->execute();
        $statement->close();
    }
    public function RemoveStanowisko(){
        global $mysqli;
        $statement = $mysqli->prepare("DELETE FROM stanowiska WHERE ID = ? LIMIT 1 ");
        $statement->bind_param("i", $this->rekord);
        $statement->execute();
        $statement->close();
    }
}


/*
 * -------------------------------------------------
 *
 *                      WIDOKI
 *
 * -------------------------------------------------
 */

class Widoki{

    public function WidokKontakty(){
        global $mysqli;
        global $glowna;
        foreach ($mysqli->query($glowna) as $row) {
            echo '<tr>';
            echo '<td>'. $row['id'] . '</td>';
            echo '<td>'. $row['Imie'] . '</td>';
            echo '<td>'. $row['Nazwisko'] . '</td>';
            echo '<td>'. $row['Firma'] . '</td>';
            echo '<td>'. $row['Oddzial'] . '</td>';
            echo '<td>'. $row['Dzial'] . '</td>';
            echo '<td>'. $row['Stanowisko'] . '</td>';
            echo '<td>'. $row['numerStacjonarny'] . '</td>';
            echo '<td>'. $row['numerKomorkowy'] . '</td>';
            echo '<td>'. $row['adresEmail'] . '</td>';
            echo '</tr>';
        }

    }
    public function WidokFirm(){
        global $mysqli;
        global $firmy;
        foreach ($mysqli->query($firmy) as $row) {
            echo '<tr>';
            echo '<td>'. $row['id'] . '</td>';
            echo '<td>'. $row['Firma'] . '</td>';
            echo '</tr>';
        }
    }
    public function WidokOddzialow(){
        global $mysqli;
        global $Oddzialy;
        foreach ($mysqli->query($Oddzialy) as $row) {
            echo '<tr>';
            echo '<td>'. $row['id'] . '</td>';
            echo '<td>'. $row['Oddzial'] . '</td>';
            echo '</tr>';
        }

    }
    public function WidokDzialow(){
        global $mysqli;
        global $dzialy;
        foreach ($mysqli->query($dzialy) as $row) {
            echo '<tr>';
            echo '<td>'. $row['id'] . '</td>';
            echo '<td>'. $row['Dzial'] . '</td>';
            echo '</tr>';
        }

    }
    public function WidokStanowisk(){
        global $mysqli;
        global $stanowiska;
        foreach ($mysqli->query($stanowiska) as $row) {
            echo '<tr>';
            echo '<td>'. $row['id'] . '</td>';
            echo '<td>'. $row['stanowisko'] . '</td>';
            echo '</tr>';
        }
    }

}


/*
 * -------------------------------------------------
 *
 *                      SELEKTY
 *
 * -------------------------------------------------
 */

class SELEKTY{

    public function WyborFirmyDoUsuniecia(){
        global $mysqli;
        $Firmquery = "SELECT * FROM firmy ORDER BY id ASC";
        $Firmresult = $mysqli->query($Firmquery);

        foreach ($Firmresult as $row)
        {
            echo '<option value="'.$row["id"].'.'.$row["Firma"].'">'.$row["id"].'.'.$row["Firma"].'</option>';
        }
    }

    public function WyborOddzialuDoUsuniecia(){
        global $mysqli;
        $Oddquery = "SELECT * FROM oddzialy ORDER BY id ASC";
        $Oddmresult = $mysqli->query($Oddquery);

        foreach ($Oddmresult as $row)
        {
            echo '<option value="'.$row["id"].'.'.$row["Oddzial"].'">'.$row["id"].'.'.$row["Oddzial"].'</option>';
        }
    }

    public function WyborDzialuDoUsuniecia(){
        global $mysqli;
        $Dzquery = "SELECT * FROM dzialy ORDER BY id ASC";
        $Dzresult = $mysqli->query($Dzquery);

        foreach ($Dzresult as $row)
        {
            echo '<option value="'.$row["id"].'.'.$row["Dzial"].'">'.$row["id"].'.'.$row["Dzial"].'</option>';
        }
    }

    public function WyborStanowiskaDoUsuniecia(){
        global $mysqli;
        $Stmquery = "SELECT * FROM stanowiska ORDER BY id ASC";
        $Stresult = $mysqli->query($Stmquery);

        foreach ($Stresult as $row)
        {
            echo '<option value="'.$row["id"].'.'.$row["stanowisko"].'">'.$row["id"].'.'.$row["stanowisko"].'</option>';
        }
    }




        public function WyborIdKontaktu(){
        global $mysqli;
        $GLiquery = "SELECT * FROM glowna ORDER BY id ASC";
        $GLiresult = $mysqli->query($GLiquery);

        foreach ($GLiresult as $row)
        {
            echo '<option value="'.$row["id"].'.'.$row["Imie"].'.'.$row["Nazwisko"].'.'.$row["Firma"].'.'.$row["Oddzial"].'.'.$row["Dzial"].'.'.$row["Stanowisko"].'.'.$row["numerStacjonarny"].'.'.$row["numerKomorkowy"].'.'.$row["adresEmail"].'">'.$row["id"].'  '.$row["Imie"].'  '.$row["Nazwisko"].'  '.$row["Firma"].'  '.$row["Oddzial"].'  '.$row["Dzial"].'  '.$row["Stanowisko"].'  '.$row["numerStacjonarny"].'  '.$row["numerKomorkowy"].'  '.$row["adresEmail"].'</option>';
        }
    }

    public function WyborKontaktu(){
        global $mysqli;
        $GLquery = "SELECT * FROM glowna ORDER BY id ASC";
        $GLresult = $mysqli->query($GLquery);

        foreach ($GLresult as $row)
        {
            echo '<option value="'.$row["id"].'.'.$row["Imie"].'.'.$row["Nazwisko"].'.'.$row["Firma"].'.'.$row["Oddzial"].'.'.$row["Dzial"].'.'.$row["Stanowisko"].'.'.$row["numerStacjonarny"].'.'.$row["numerKomorkowy"].'.'.$row["adresEmail"].'">'.$row["id"].'  '.$row["Imie"].'  '.$row["Nazwisko"].'  '.$row["Firma"].'  '.$row["Oddzial"].'  '.$row["Dzial"].'  '.$row["Stanowisko"].'  '.$row["numerStacjonarny"].'  '.$row["numerKomorkowy"].'  '.$row["adresEmail"].'</option>';
        }
    }
    public function WyborFirmy(){
        global $mysqli;
        $Firmquery = "SELECT * FROM firmy ORDER BY id ASC";
        $Firmresult = $mysqli->query($Firmquery);

        foreach ($Firmresult as $row)
        {
            echo '<option value="'.$row["Firma"].'">'.$row["Firma"].'</option>';
        }
    }

    public function WyborOddzialu(){
        global $mysqli;
        $Oddquery = "SELECT * FROM oddzialy ORDER BY id ASC";
        $Oddmresult = $mysqli->query($Oddquery);

        foreach ($Oddmresult as $row)
        {
            echo '<option value="'.$row["Oddzial"].'">'.$row["Oddzial"].'</option>';
        }
    }

    public function WyborDzialu(){
        global $mysqli;
        $Dzquery = "SELECT * FROM dzialy ORDER BY id ASC";
        $Dzresult = $mysqli->query($Dzquery);

        foreach ($Dzresult as $row)
        {
            echo '<option value="'.$row["Dzial"].'">'.$row["Dzial"].'</option>';
        }
    }

    public function WyborStanowiska(){
        global $mysqli;
        $Stmquery = "SELECT * FROM stanowiska ORDER BY id ASC";
        $Stresult = $mysqli->query($Stmquery);

        foreach ($Stresult as $row)
        {
            echo '<option value="'.$row["stanowisko"].'">'.$row["stanowisko"].'</option>';
        }
    }



}

class dtm_livespace
{

    var $_ls_api = array();
    var $_ls = null;
    private $_ls_code;

    function __construct()
    {

//        $this->_ls_api = array(
//            'api_url' => 'https://dbk4.livespace.io',
//            'api_key' => 'd34fnf65h48crubkaf7kgnrta4bzh1',
//            'api_secret' => 'qu5v9tagysl74c2');
//        $this->_ls_api = array(
//            'api_url' => 'https://dbk4.livespace.io',
//            'api_key' => 'osd9pxfalci2bcvvmwz3b3oy9f929x',
//            'api_secret' => 'dypq8fnop908bck'
//        );
//        tech_user NI
        $this->_ls_api = array(
            'api_url' => 'https://dbk.livespace.io',
            'api_key' => 'd34fnf65h48crubkaf7kgnrta4bzh1',
            'api_secret' => 'qu5v9tagysl74c2');

        $this->_ls = new LiveSpace(
            array(
                'api_url' => $this->_ls_api['api_url'],
                'api_key' => $this->_ls_api['api_key'],
                'api_secret' => $this->_ls_api['api_secret']
            )
        );

        $this->_ls_code = array(
            200 => "OK",
            400 => "b????d og??lny",
            420 => "b????d walidacji",
            500 => "b????d og??lny api",
            514 => "niepoprawny modu??",
            515 => "niepoprawna metoda",
            516 => "niepoprawny format wyj??cia",
            520 => "b????d komunikacji z baz??",
            530 => "u??ytkownik niezalogowany",
            540 => "brak uprawnie??",
            550 => "b????d obs??ugi parametr??w",
            560 => "niepoprawna metoda",
            561 => "niepoprawne parametry",
            562 => "niepoprawny klucz",
            563 => "brak autoryzacji",
            564 => "b????d og??lny"
        );


    }



}





class WidokKontaktow
{

    private $task = "";

    function __construct()
    {

        $this->task = empty($_GET['task']) ? 'show' : $_GET['task'];

        switch ($this->task) {
            case "getData":
                echo $this->getContactsData();
                exit;
            default:
                $this->show();
                break;
        }
    }

    private function showContacts()
    {
        $html = "";
        $html .= "<div class='row justify-content-center mb-5'> 
                    <h1>Tabela Kontakty</h1>
                </div>";
        $html .= $this->createFilters();
        $html .= '<div class="row justify-content-center">
                    <div class="col-auto">';
        $html .= "<table id=\"tabela_Kontakty\" class=\"table table-sm2 table-bordered table-hover \" style=\"width:100%\">        
                        <thead class=\"bg-primary text-white\">
                        </thead>
                        <tbody>
                        </tbody>             
                    </table>";
        $html .= "    </div>
                  </div>";
        $html .= "<script src='/js2/Kontaktyjs.js'></script>";

        v4function::displayBoxMainContent($html, "Tabela Kontakty");
    }

//    private function getContactsData()
   // {
//
//        $query = "SELECT id, Imie, Nazwisko, Firma, Oddzial, Dzial, Stanowisko, numerStacjonarny, numerKomorkowy,adresEmail
//                 FROM glowna ORDER BY id DESC";
//        $data = query2array($query);
//        $data = array("data" => $data);
//        header("Content-type: application/json");
//        return json_encode($data);
//    }










    private function createFilters()
    {
        $form = new Form("filters");
        $form->configure(array(
                "action" => "#",
                "prevent" => array("bootstrap", "jQuery"),
                "view" => new View_SideBySide4IntraNoLabel(),
                'errorView' => new ErrorView_IntraPL(),
                "resourcesPath" => 'inc/PFBC/Resources',
                "ajaxCallback" => "finishCallback"
            )
        );
        $html = "";
        $options = array(
            '0' => "Wszystkie",
            'A' => "Tabela A - ??redni kurs",
            'C' => "Tabela C - Kupno i sprzeda??",
        );
        $form->addElement(new Element_HTML('<div class="row justify-content-center mb-3">'));
        $form->addElement(new Element_Select("Typ kursu:", '', $options, array('id' => 'type-filter', 'shared' => 'col-2', "class" => "form-control")));
        $form->addElement(new Element_jQueryUIDate2("Data publikacji:", 'date-filter', array('id' => 'date-filter', "class" => "form-control", 'shared' => 'col-2')));
        $form->addElement(new Element_Button('Wyczy???? filtry', 'button', array('id' => 'clear-filter', 'class' => 'btn btn-primary mt-4')));
        $form->addElement(new Element_HTML('</div>'));

        $html .= $form->render(null, TRUE);

        return $html;
    }


}



























function query2array($query = "", $fetchMode = MDB2_FETCHMODE_ASSOC, $db = null) {
    global $mysqli;
    if (empty($db)) {
        $db = $mysqli;
    }
    try {
        $res = $db->query($query);
        if (PEAR::isError($res)) {
            messagehtml(errQueryMDB2($res->getuserinfo() . "<br />" . $query), "error");
        }
    } catch (Exception $e) {
        messagehtml($e->getMessage() . "<br />" . $query, "error");
    }
    $aLista = $res->fetchAll($fetchMode);

    return $aLista;
}


class Nav{

    function navBarKon(){

        $navbar='';
        $navbar .= " <nav class='navbar navbar-expand-lg navbar-light bg-primary '> 
            <div class='btn-group'>
        <button style='margin-left: 20px' type='button' class='btn btn-lg btn-warning margin-left: 200px'>Kontakty</button>
        <button type='button' class='btn btn-lg btn-success'>+</button>
    </div>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WFirmy.php'>Firmy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WOddzialy.php'>Oddzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WDzialy.php'>Dzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WStanowiska.php'>Stanowiska</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='index.php'>Strona G????wna</button>
</nav>
        " ;
        echo $navbar;


    }
    function navBarFir(){
        $navbar='';
        $navbar .= " <nav class='navbar navbar-expand-lg navbar-light bg-primary '> 
            <div class='btn-group'>
        <button style='margin-left: 20px' type='button' class='btn btn-lg btn-warning margin-left: 200px'>Firmy</button>
        <button type='button' name='FirmaBtn' id='FirmaBtn' class='btn btn-lg btn-success'>+</button>
    </div>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='contacts.php'>Kontakty</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WOddzialy.php'>Oddzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WDzialy.php'>Dzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WStanowiska.php'>Stanowiska</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='index.php'>Strona G????wna</button>
</nav>
        " ;
        echo $navbar;


    }
    function navBarOdd(){

        $navbar='';
        $navbar .= " <nav class='navbar navbar-expand-lg navbar-light bg-primary '> 
            <div class='btn-group'>
        <button style='margin-left: 20px' type='button' class='btn btn-lg btn-warning margin-left: 200px'>Oddzialy</button>
        <button type='button' class='btn btn-lg btn-success'>+</button>
    </div>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='contacts.php'>Kontakty</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WFirmy.php'>Firmy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WDzialy.php'>Dzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WStanowiska.php'>Stanowiska</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='index.php'>Strona G????wna</button>
</nav>
        " ;
        echo $navbar;


    }
    function navBarDzi(){

        $navbar='';
        $navbar .= " <nav class='navbar navbar-expand-lg navbar-light bg-primary '> 
            <div class='btn-group'>
        <button style='margin-left: 20px' type='button' class='btn btn-lg btn-warning margin-left: 200px'>Dzialy</button>
        <button type='button' class='btn btn-lg btn-success'>+</button>
    </div>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='contacts.php'>Kontakty</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WFirmy.php'>Firmy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WOddzialy.php'>Oddzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WStanowiska.php'>Stanowiska</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='index.php'>Strona G????wna</button>
</nav>
        " ;
        echo $navbar;


    }
    function navBarSta(){

        $navbar='';
        $navbar .= " <nav class='navbar navbar-expand-lg navbar-light bg-primary '> 
            <div class='btn-group'>
        <button style='margin-left: 20px' type='button' class='btn btn-lg btn-warning margin-left: 200px'>Stanowiska</button>
        <button type='button' class='btn btn-lg btn-success'>+</button>
    </div>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='contacts.php'>Kontakty</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WFirmy.php'>Firmy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WOddzialy.php'>Oddzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WDzialy.php'>Dzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='index.php'>Strona G????wna</button>
</nav>
        " ;
        echo $navbar;


    }
    function navBarIndex(){

        $navbar='';
        $navbar .= " <nav class='navbar navbar-expand-lg navbar-light bg-primary '> 
        <button href=''#' class='btn btn-lg btn-primary margin-left: 200px' onclick=location.href='contacts.php'>Kontakty</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WFirmy.php'>Firmy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WOddzialy.php'>Oddzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WDzialy.php'>Dzialy</button>
        <button href=''#' class='btn btn-lg btn-primary' onclick=location.href='WStanowiska.php'>Stanowiska</button>  
</nav>
        " ;
        echo $navbar;


    }





}


class Modals{

function FirmModal()
{
    $FirmModal = '';
    $FirmModal .= "<div class='modal fade' id='EditModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Dodawanie Firmy</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form>
                    <div class='form-group'>
                        <label for='exampleInputEmail1'>Nazwa Firmy</label>
                        <input type='text' required id='Firm1' name='Firm1' aria-describedby='emailHelp' placeholder='Podaj Nazwe Firmy'>
                    </div>
                    <button type='submit' id='SubmitFirm' name='SubmitFirm' class='btn btn-primary'>Submit</button>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
            </div>
        </div>
    </div>
</div>";

    echo $FirmModal;

}



//////////////////////////////////////////////////////////////////////////////
    function OddzialModal()
    {
        $OddzialModal = '';
        $OddzialModal .= "<div class='modal fade' id='EditModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Dodawanie Oddzialu</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form>
                    <div class='form-group'>
                        <label for='exampleInputEmail1'>Podaj Nazwe Oddzialu</label>
                        <input type='text' required id='Oddzial1' name='Oddzial1' aria-describedby='emailHelp' placeholder='Podaj Nazwe oddzialu'>
                    </div>
                    <button type='submit' id='SubmitOddzial' name='SubmitOddzial' class='btn btn-primary'>Submit</button>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
            </div>
        </div>
    </div>
</div>";

        echo $OddzialModal;

    }

    ////////////////////////////////////////////////////////////////////


    function DzialModal()
    {
        $DzialModal = '';
        $DzialModal .= "<div class='modal fade' id='EditModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Dodawanie Dzia??u</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form>
                    <div class='form-group'>
                        <label for='exampleInputEmail1'>Podaj Nazwe Dzia??u</label>
                        <input type='text' required id='Dzial1' name='Dzial1' aria-describedby='emailHelp' placeholder='Podaj Nazwe Dzia??u'>
                    </div>
                    <button type='submit' id='SubmitDzial' name='SubmitDzial' class='btn btn-primary'>Submit</button>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
            </div>
        </div>
    </div>
</div>";

        echo $DzialModal;

    }


////////////////////////////////////////////////////////////////////////


    function StanowiskoModal()
    {
        $StanowiskoModal = '';
        $StanowiskoModal .= "<div class='modal fade' id='EditModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>Dodawanie Stanowisk</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form>
                    <div class='form-group'>
                        <label for='exampleInputEmail1'>Podaj Nazwe Stanowiska</label>
                        <input type='text' required id='Stanowisko1' name='Stanowisko1' aria-describedby='emailHelp' placeholder='Podaj Nazwe Stanowiska'>
                    </div>
                    <button type='submit' id='SubmitStanowisko' name='SubmitStanowisko' class='btn btn-primary'>Submit</button>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
            </div>
        </div>
    </div>
</div>";

        echo $StanowiskoModal;

    }








}












?>