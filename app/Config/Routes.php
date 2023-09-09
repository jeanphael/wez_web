<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('lphome');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'AgendaWSControler::index');
//$routes->get('event/(:any)', 'EventController::index');
$routes->get('services/', 'EventWSController::index');													 
$routes->get('services/boindex/', 'EventController::boindex');													 
$routes->post('services/ticket/', 'TicketWSController::index');
$routes->post('services/likeList/', 'EventWSController::listLike');
$routes->post('services/price/', 'PriceWSController::index');
$routes->post('services/price/liste', 'PriceWSController::priceList');
$routes->post('services/price/byidevent', 'PriceWSController::priceByEvent');
$routes->post('services/place/', 'PlaceWSController::placeList');
$routes->post('services/place/liste', 'PlaceWSController::placeList');
$routes->post('services/place/save', 'PlaceWSController::savePlace');
$routes->post('services/picture/', 'PictureWSController::index');
$routes->post('services/picture/liste', 'PictureWSController::pictureList');
$routes->post('services/picture/save', 'PictureWSController::savePicture');
$routes->post('services/picture/update', 'PictureWSController::updatePicture');
$routes->post('services/picture/delete', 'PictureWSController::deletePicture');
$routes->post('services/pointofsale/', 'PointOfSaleWSController::index');
$routes->post('services/pointofsale/liste', 'PointOfSaleWSController::pointOfSaleList');
$routes->post('services/pointofsale/byid', 'PointOfSaleWSController::pointOfSaleById');
$routes->post('services/pointofsale/byidevent', 'PointOfSaleWSController::pointOfSaleByIdEvent');
$routes->post('services/pointofsale/save', 'PointOfSaleWSController::savePointOfSale');
$routes->post('services/pointofsale/update', 'PointOfSaleWSController::updatePointOfSale');
$routes->post('services/pointofsale/delete', 'PointOfSaleWSController::deletePointOfSale');
$routes->post('services/organizer/', 'OrganizerWSController::index');
$routes->post('services/organizer/liste', 'OrganizerWSController::organizerList');
$routes->post('services/organizer/byid', 'OrganizerWSController::organizerById');
$routes->post('services/organizer/details', 'OrganizerWSController::organizerDetails');
$routes->post('services/organizer/follow', 'OrganizerWSController::organizerFollow');
$routes->post('services/organizer/listOrganizerFollowedByUser', 'OrganizerWSController::followListByIdUser');
$routes->post('services/organizer/countFollow', 'OrganizerWSController::countFollow');
$routes->post('services/organizer/save', 'OrganizerWSController::saveOrganizerC');
$routes->post('services/organizer/update', 'OrganizerWSController::updateOrganizer');
$routes->post('services/organizer/delete', 'OrganizerWSController::deleteOrganizer');
$routes->post('services/agenda/', 'OrganizerWSController::index');
$routes->post('services/agenda/liste', 'OrganizerWSController::agendaList');
$routes->post('services/agenda/byid', 'OrganizerWSController::agendaListByIdUser');
$routes->post('services/agenda/save', 'OrganizerWSController::agendaSave');
$routes->post('services/event/', 'EventWSController::index');
$routes->post('services/event/liste', 'EventWSController::eventList');
$routes->get('services/event/liste', 'EventWSController::eventList');
$routes->post('services/event/listEventLikingByUser', 'EventWSController::searchLikeByIdUser');
$routes->post('services/event/getIDEventByIdUser', 'EventWSController::getIDEventByIdUser');
$routes->post('services/event/byid', 'EventWSController::eventById');
$routes->post('services/event/details', 'EventWSController::eventDetails');
$routes->get('services/event/details', 'EventWSController::eventDetails');
$routes->post('services/event/eventByName', 'EventWSController::eventSearchByName');
$routes->post('services/event/eventByDate', 'EventWSController::eventSearchByDate');
$routes->post('services/event/eventByPlace', 'EventWSController::eventSearchByPlace');
$routes->post('services/event/eventByCity', 'EventWSController::eventSearchByCity');
$routes->post('services/event/eventByCategory', 'EventWSController::eventSearchByCategory');
$routes->post('services/event/eventByOrganizer', 'EventWSController::eventSearchByOrganizer');
$routes->post('services/event/countLikeByEvent', 'EventWSController::countLike');
$routes->post('services/event/like', 'EventWSController::likeEvent');
$routes->post('services/event/search', 'EventWSController::eventSearch');
$routes->post('services/event/save', 'EventWSController::saveEvent');
$routes->post('services/event/update', 'EventWSController::updateEvent');
$routes->post('services/event/delete', 'EventWSController::deleteEvent');
$routes->post('services/user/liste', 'UserWSController::userList');
$routes->post('services/user/likeEvent', 'UserWSController::listeUserLikingAnEvent');
$routes->post('services/user/listFollowers', 'UserWSController::listFollowers');
$routes->post('services/user/byid', 'UserWSController::userById');
$routes->post('services/user/register', 'UserWSController::userRegistration');
$routes->post('services/user/connexion', 'UserWSController::userConnexion');
$routes->post('services/user/update', 'UserWSController::updateUser');
$routes->post('services/user/delete', 'UserWSController::deleteUser');
$routes->post('services/token/save', 'TokenWSController::saveToken');
$routes->post('services/category/byid', 'CategoryWSController::categoryById');
$routes->post('services/category/list', 'CategoryWSController::categoryList');
$routes->post('services/category/list/limit', 'CategoryWSController::categoryListLimit');
$routes->get('services/city/list', 'CityWSController::cityList');
$routes->get('reset/password', 'UserController::changePwd');
$routes->post('sendmail/reset/password', 'UserController::resetPwdRefonte');
$routes->post('services/reset', 'UserWSController::resetPwd');
$routes->post('services/confidentialite', 'UserWSController::showPageConfidentialite');
$routes->get('services/confidentialite', 'UserWSController::showPageConfidentialite');


/* Before printing pages */

/*$routes->get('login', 'UserController::loginpage');*/
$routes->get('services/login', 'UserController::connexionRefonte');
$routes->get('services/event_list', 'EventController::liste');
$routes->get('services/event_list_tovalidate', 'EventController::listeToValidate');
$routes->get('services/event_new', 'EventController::ajout');
$routes->get('services/event_similar', 'EventController::getSimilarEvent');
$routes->post('event/validate', 'EventController::eventvalidate');		
$routes->post('services/event/delete/list', 'EventController::eventDeleteList');		
$routes->get('services/event_validate', 'EventController::validateEvent');
$routes->get('services/event_list_similar', 'EventController::getListSimilarEventByCategory');
$routes->get('services/event_list_notPublished', 'EventController::getListEventsnotPublished');
$routes->get('services/event_list_byOrganizer', 'EventController::getListEventByOrganizer');
$routes->get('services/dashboard', 'Home::index');
$routes->get('services/organizer_list', 'OrganizerController::liste');
$routes->get('services/organizer_new', 'OrganizerController::ajout');
$routes->get('services/organizer_follow', 'OrganizerController::suivi');
$routes->get('services/pos_list', 'PointOfSaleController::liste');
$routes->get('services/pos_new', 'PointOfSaleController::ajout');
$routes->get('services/pos_new_ticket', 'PointOfSaleController::addTicket');
$routes->get('services/agenda_list', 'AgendaController::liste');
$routes->get('services/services/user_new', 'UserController::ajout');
$routes->get('services/user_connection', 'UserController::connection');
$routes->get('services/user_list', 'UserController::liste');
$routes->get('services/user_update', 'UserController::update');
$routes->get('services/rate', 'PriceController::priceList');
$routes->get('services/city', 'CityController::cityList');
$routes->get('services/place', 'PlaceController::placeList');
$routes->get('services/category', 'CategoryController::categoryList');
$routes->get('services/picture', 'PictureController::index');
$routes->get('services/event_like', 'EventController::searchLikeByIdUser');
$routes->get('services/follow_list', 'UserController::listeUserFollowingAnOrganizer');
$routes->get('services/follow', 'OrganizerController::followListByIdUser');
$routes->post('services/city/save', 'CityController::saveCityWS');
$routes->post('services/user/connexionByEmail', 'UserWSController::loginByEmail');
$routes->post('services/user/changePassword', 'UserWSController::changePassword');


/*After form validation */
$routes->post('event_updateValidate', 'EventController::updateEvent');
$routes->post('placeUpdateValidate', 'PlaceController::updatePlace');
$routes->post('priceUpdateValidate', 'PriceController::updatePrice');
$routes->post('category_insert', 'CategoryController::saveCategory');
$routes->post('category_insert_post', 'CategoryController::saveCategoryGet');
$routes->post('gestion/category_update_post', 'CategoryController::updateCategoryModal');
$routes->post('gestion/category_insert_post', 'CategoryController::saveCategoryModal');
$routes->post('city_insert', 'CityController::saveCity');
$routes->post('city_insert_post', 'CityController::saveCityPost');
$routes->post('picture_save', 'PictureController::savePicture');
$routes->post('place_save', 'PlaceController::savePlace');
$routes->post('evenement/save/place', 'PlaceController::savePlaceGet');
$routes->post('place_save_post', 'PlaceController::savePlaceGet');
$routes->post('gestion/place_save_post', 'PlaceController::savePlaceGet');
$routes->post('gestion/place_update_post', 'PlaceController::updatePlaceAjax');
$routes->post('gestion/printprice_update', 'GestionController::updatePrintPriceAjax');
$routes->post('place_list_json', 'PlaceController::getListPlaceJsonFormat');

$routes->post('price_save', 'PriceController::savePrice');
$routes->post('event_save', 'EventController::save');
$routes->post('organizer_save', 'OrganizerController::save');
$routes->post('organizer_save_post', 'OrganizerController::savePost');
$routes->post('user_save', 'UserController::save');
$routes->get('send_email', 'UserController::sendEmail');
$routes->post('user_by_login', 'UserController::userByLogin');
$routes->post('user_by_email', 'UserController::userByEmail');
$routes->post('pos_save', 'PointOfSaleController::save');
$routes->post('pdv_save_post', 'PointOfSaleController::savePost');
$routes->post('pos/save', 'PointOfSaleController::savePostAjax');
$routes->post('evenement/pos/save', 'PointOfSaleController::savePostAjax');

$routes->post('pos/update', 'PointOfSaleController::updatePosAjax');
$routes->get('pos_update', 'PointOfSaleController::update');
$routes->post('pos_updateValidate', 'PointOfSaleController::updatePointOfSale');
$routes->get('organizer_update', 'OrganizerController::update');
$routes->get('event_update', 'EventController::update');
$routes->get('price_update', 'PriceController::update');
$routes->get('place_update', 'PlaceController::update');
$routes->get('category_update', 'CategoryController::update');
$routes->get('city_update', 'CityController::update');
$routes->get('user_update', 'UserController::update');
$routes->get('user_manage_admin', 'UserController::manageAdmin');
$routes->post('category_updateValidate', 'CategoryController::updateCategory');
$routes->post('city_updateValidate', 'CityController::updateCity');
$routes->post('organizer_updateValidate', 'OrganizerController::updateOrganizer');
$routes->post('user_updateValidate', 'UserController::updateUser');
$routes->post('connection', 'UserController::userConn');
$routes->get('event_delete', 'EventController::delete');
$routes->get('organizer_delete', 'OrganizerController::deleteOrganizer');
$routes->get('pdv_delete', 'PointOfSaleController::deletePointOfSale');
$routes->get('user_delete', 'UserController::deleteUser');
$routes->get('gestion/price_delete', 'PriceController::deletePrice');
$routes->get('user_delete_admin', 'UserController::deleteUserAdmin');
$routes->get('price_delete', 'PriceController::deletePriceOld');
$routes->get('price_insert_post', 'PriceController::savePost');
$routes->post('gestion/price_save_post', 'PriceController::savePostModal');
$routes->post('gestion/price_update_post', 'PriceController::updatePostModal');
$routes->post('place_save_post', 'PlaceController::savePost');
$routes->get('place_delete', 'PlaceController::deletePlaceOld');																		   
$routes->get('gestion/place_delete', 'PlaceController::deletePlace');																			   
$routes->get('gestion/category_delete', 'CategoryController::deleteCategory');
$routes->get('place_delete', 'PlaceController::deletePlace');
$routes->get('city_delete', 'CityController::deleteCity');
$routes->get('category_delete', 'CategoryController::deleteCategoryOld');
$routes->get('profil/resetPassword', 'UserController::resetPassword');
$routes->get('list_user_like', 'UserController::listeUserLikingAnEvent');
$routes->get('form_reinit_pwd', 'UserController::formReinitPwd');
$routes->get('services/form_reinit_pwd', 'UserController::formReinitPwd');
$routes->post('validation_reinit_password', 'UserController::validationReinitPassword');
$routes->post('validation_reset_password', 'UserController::validationResetPassword');
$routes->get('test_send_email', 'UserController::testSendEmail');																  
$routes->post('validation_reinit_pwd', 'UserController::validationReinitPwd');
$routes->post('validate_reset_pwd', 'UserController::validateresetpwd');
$routes->get('reset', 'UserController::reset');
$routes->get('event_details', 'EventController::details');
$routes->get('event_price_manage', 'EventController::gestionPrixAffichage');
$routes->post('add_print_price', 'EventController::ajoutPrixAffichage');
$routes->post('update_print_price', 'EventController::updatePrixAffiage');
$routes->post('test_push', 'EventController::sendNotificationTest');

$routes->get('send', 'OrganizerController::send');
$routes->get('activate', 'OrganizerController::activateAccount');
$routes->get('account/activate', 'OrganizerController::pageActivation');
$routes->get('mail/send', 'UserController::sendTest');
//$routes->get('testaa', 'UserController::validationReinitPwd');

$routes->post('admin/save', 'UserController::saveUserAdmin');
$routes->post('admin/update', 'UserController::updateUserAdmin');
$routes->post('organisateur/insertion', 'OrganizerController::saveUserOrg');
$routes->post('organisateur/misajour', 'OrganizerController::updateUserOrg');


// debut refonte 

$routes->get('services/connexion', 'UserController::connexionRefonte');
$routes->get('deconnexion', 'UserController::deconnexionRefonte');
$routes->post('connexion-validation-refonte', 'UserController::connexionValidationRefonte');
$routes->get('evenement-list-refonte', 'EventController::listeRefonte');
$routes->post('testsendpush', 'EventController::sendNotification');
$routes->get('organisateur-list-refonte', 'OrganizerController::listeRefonte');
$routes->get('administrateur-list-refonte', 'UserController::listeAdminRefonte');
$routes->get('utilisateur-list-refonte', 'UserController::listeRefonte');
$routes->get('gestion/tarif', 'GestionController::tarif');
$routes->get('gestion/cout', 'GestionController::cout');
$routes->get('gestion/categorie', 'GestionController::categorie');
$routes->get('gestion/lieu', 'GestionController::lieu');
$routes->get('administrateur/ajout', 'UserController::pageAjoutAdmin');
$routes->get('organisateur/ajout', 'UserController::pageAjoutOrganisateur');
$routes->get('evenement/ajout', 'EventController::pageAjoutEvenement');
$routes->get('evenement-info-avalider', 'EventController::pageInfoEvent');
$routes->get('admin/update', 'UserController::pageUpdateAdmin');
$routes->get('admin/delete', 'UserController::pageDeleteAdmin');
$routes->get('organisateur/delete', 'UserController::pageDeleteOrg');
$routes->get('profil/delete', 'UserController::pageDeleteMonCompte');
$routes->get('profil/changePwd', 'UserController::changePwd');
$routes->get('profil', 'UserController::pageProfil');
$routes->get('user/delete', 'UserController::pageDeleteUser');
$routes->get('organizer/update', 'UserController::pageUpdateOrganizer');
$routes->get('organizer/delete', 'UserController::pageDeleteOrganizer');
$routes->get('event/update', 'EventController::pageUpdateEvent');
$routes->get('event/like/list', 'EventController::searchEventLikedByIdUser');
$routes->get('follow/list', 'OrganizerController::searchOrganizerfollowedByIdUser');
$routes->get('evenement/info', 'EventController::pageInfoEvent');
$routes->post('pos/search', 'PointOfSaleController::search');
$routes->post('user/search', 'UserController::search');
$routes->post('user/admin/search', 'UserController::searchAdmin');

$routes->post('gestion/lieu/search', 'GestionController::searchLieu');
$routes->post('gestion/category/search', 'GestionController::searchCategory');
$routes->get('delete-event', 'EventController::deleteEvent');
$routes->post('organizer/search', 'OrganizerController::searchOrganizer');
$routes->post('profil/update-profil', 'UserController::updateProfil');

$routes->post('save-new-event', 'EventController::saveRefont');

$routes->post('save-update-event', 'EventController::updateEventRefonte');

$routes->post('services/event/detailsById', 'EventWSController::eventDetailsById');
$routes->post('event-update-state', 'EventController::eventUpdateState');
$routes->post('event-search-multi', 'EventController::eventSearchMulti');
$routes->get('event/list/rejected', 'EventController::listRejected');
$routes->get('event/list/published', 'EventController::listPublished');
$routes->get('event/list/notpublished', 'EventController::listNotPublished');
$routes->get('event/remove', 'EventController::deleteEvent');
$routes->post('event-filter', 'EventController::eventFilter');
$routes->post('evenement/ville/top', 'EventController::checkIfExistTopEventInCity');

//fin refonte

//Landing page
$routes->get('connexion', 'UserController::lpconnexion');
$routes->get('inscription', 'UserController::lpregistration');
$routes->get('confidentialite', 'UserController::lpconfidentialite');
$routes->get('utilisation', 'UserController::lputilisation');
//$routes->get('', 'UserController::lphome');
$routes->get('services/testacron', 'UserController::testacron');
$routes->post('event/changeList', 'EventController::getEventByCatLp');
$routes->post('event/getMinPrice', 'EventController::getMinPrice');
$routes->post('services/config/deletion', 'EventWSController::fbDelection');









//$routes->get('price/', 'PriceWSControler:priceById/');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}