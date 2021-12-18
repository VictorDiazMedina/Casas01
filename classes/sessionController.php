<?php

require_once 'classes/session.php';
require_once 'models/usermodel.php';
require_once 'models/housemodel.php';

/**
 * Controlador que también maneja las sesiones
 */
class SessionController extends Controller{
    
    private $userSession;
    private $userWhats;
    private $userid;

    private $session;
    private $sites;

    private $user;
    private $house;
 
    function __construct(){
        parent::__construct();
        $this->init();
    }

    public function getUserSession(){
        return $this->userSession;
    }

    public function getUserWhats(){
        return $this->userWhats;
    }

    public function getUserId(){
        return $this->userid;
    }

    /**
     * Inicializa el parser para leer el Access.json
     */
    private function init(){
        //se crea nueva sesión
        $this->session = new Session();
        //se carga el archivo json con la configuración de acceso
        $json = $this->getJSONFileConfig();
        // se asignan los sitios
        $this->sites = $json['sites'];
        // se asignan los sitios por default, los que cualquier rol tiene acceso
        $this->defaultSites = $json['default-sites'];
        // inicia el flujo de validación para determinar
        // el tipo de rol y permisos
        $this->validateSession();
    }
    /**
     * Abre el archivo JSON y regresa el resultado decodificado
     */
    private function getJSONFileConfig(){
        $string = file_get_contents("config/access.json");
        $json = json_decode($string, true);

        return $json;
    }

    /**
     * Implementa el flujo de autorización
     * para entrar a las páginas
     */
    function validateSession(){
        error_log('SessionController::validateSession()');
        //Si existe la sesión
        if($this->existsSession()){
            $role = $this->getUserSessionData()->getRole();

            error_log("sessionController::validateSession(): username:" . $this->user->getUserWhats() . " - role: " . $this->user->getRole());
            if($this->isPublic()){
                $this->redirectDefaultSiteByRole($role);
                error_log( "SessionController::validateSession() => sitio público, redirige al main de cada rol" );
            }else{
                if($this->isAuthorized($role)){
                    error_log( "SessionController::validateSession() => autorizado, lo deja pasar" );
                    //si el usuario está en una página de acuerdo
                    // a sus permisos termina el flujo
                }else{
                    error_log( "SessionController::validateSession() => no autorizado, redirige al main de cada rol" );
                    // si el usuario no tiene permiso para estar en
                    // esa página lo redirije a la página de inicio
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        }else{
            //No existe ninguna sesión
            //se valida si el acceso es público o no
            if($this->isPublic()){
                error_log('SessionController::validateSession() public page');
                //la pagina es publica
                //no pasa nada
            }else{
                //la página no es pública
                //redirect al inicio
                error_log('SessionController::validateSession() redirect al inicio');
                header('location: '. constant('URL') . '');
            }
        }
    }
    /**
     * Valida si existe sesión, 
     * si es verdadero regresa el usuario actual
     */
    function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();

        if($userid) return true;

        return false;
    }

    /**
     * Crear un nuevo Modelo del Usuario
     * para utilizar sus propiedades
     */
    function getUserSessionData(){
        $id = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($id);
        error_log("sessionController::getUserSessionData(): " . $this->user->getUserWhats());
        return $this->user;
    }

    /**
     * Crear un nuevo Modelo del Casa con respecto al Usuario
     * para utilizar sus propiedades
     */
    function getHouseSessionData(){
        $id = $this->session->getCurrentUser();
        $this->house = new HouseModel();
        $this->house->getIdUser($id);
        error_log("sessionController::getHouseSessionData(): " . $this->house->getCasaNombre());
        return $this->house;
    }

    /**
     * Permite el acceso cuando Inicia sesion correctamente
     */
    public function initialize($user){
        error_log("sessionController::initialize(): user: " . $user->getUserWhats());
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRole());
    }

     /**
     * Verificar la URL que la pagina que ha entrado, sea publico
     */
    private function isPublic(){
        $currentURL = $this->getCurrentPage();
        error_log("sessionController::isPublic(): currentURL => " . $currentURL);
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                return true;
            }
        }
        return false;
    }

    /**
     * Redireccionar al Usuario al entrar en sitios no permitidos
     * Se redirecciona a su Index principal
     */
    private function redirectDefaultSiteByRole($role){
        $url = '';
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($this->sites[$i]['role'] === $role){
                $url = '/Casas01/'.$this->sites[$i]['site'];
            break;
            }
        }
        header('location: '.$url);
        
    }

    /**
     * Verificar si el usuario esta autorizado entrar a la
     * pagina que esta navegando
     */
    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace( "/\?.*/", "", $currentURL); //omitir get info
        
        for($i = 0; $i < sizeof($this->sites); $i++){
            if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                return true;
            }
        }
        return false;
    }

     /**
     * Obtener la URL actual
     * para saber cual pagina de vista esta entrando
     */
    private function getCurrentPage(){
        
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        error_log("sessionController::getCurrentPage(): actualLink =>" . $actual_link . ", url => " . $url[2]);
        return $url[2];
    }


    /**
     * Redireccionar al Usuario a su pagina principal cuando
     * se Inicia sesion
     */
    function authorizeAccess($role){
        error_log("sessionController::authorizeAccess(): role: $role");
        switch($role){
            case 'user':
                $this->redirect($this->defaultSites['anfitrion']);
            break;
            case 'admin':
                $this->redirect($this->defaultSites['admin']);
            break;
            default:
        }
    }

    /**
     * Cierra Sesion
     */
    function logout(){
        $this->session->closeSession();
    }
}


?>