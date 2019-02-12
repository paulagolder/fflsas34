<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // imageroute
        if ('/web/newimages' === $pathinfo) {
            return array('_route' => 'imageroute');
        }

        // index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\AccueilController::ShowFrench',  '_route' => 'index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'index'));
            }

            return $ret;
        }
        not_index:

        // index_en
        if ('/en/accueil' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\AccueilController::ShowEnglish',  '_route' => 'index_en',);
        }

        // index_fr
        if ('/fr/accueil' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\AccueilController::showFrench',  '_route' => 'index_fr',);
        }

        // accueil
        if ('/accueil' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\AccueilController::Showtest',  '_route' => 'accueil',);
        }

        // adminlang
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/adminlang/(?P<oldpath>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'adminlang')), array (  '_controller' => 'AppBundle\\Controller\\AdminlangController::Changelang',));
        }

        // login
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/login$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login')), array (  '_controller' => 'AppBundle\\Controller\\SecurityController::login',));
        }

        // logout
        if ('/logout' === $pathinfo) {
            return array('_route' => 'logout');
        }

        // logout_en
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/logout$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'logout_en')), array ());
        }

        // login_check
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/login_check$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_check')), array (  '_controller' => 'AppBundle\\Controller\\SecurityController::loginCheckAction',));
        }

        // register
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/register$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'register')), array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::register',));
        }

        // complete_registration
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/complete/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'complete_registration')), array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::complete',));
        }

        // remote_complete_registration
        if (0 === strpos($pathinfo, '/remotecomplete') && preg_match('#^/remotecomplete/(?P<uid>[^/]++)/(?P<code>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'remote_complete_registration')), array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::remotecomplete',));
        }

        // message_mail
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/mailto$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_mail')), array (  '_controller' => 'AppBundle\\Controller\\MessageController:createMessage',));
        }

        if (0 === strpos($pathinfo, '/admin/message')) {
            // messages_show_all
            if ('/admin/message/all' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\MessageController:showMessages',  '_route' => 'messages_show_all',);
            }

            // message_show_one
            if (preg_match('#^/admin/message/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_show_one')), array (  '_controller' => 'AppBundle\\Controller\\MessageController:showAdminMessage',));
            }

            // message_delete
            if (0 === strpos($pathinfo, '/admin/message/delete') && preg_match('#^/admin/message/delete/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_delete')), array (  '_controller' => 'AppBundle\\Controller\\MessageController:deleteMessage',));
            }

            // message_send
            if (0 === strpos($pathinfo, '/admin/message/send') && preg_match('#^/admin/message/send/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_send')), array (  '_controller' => 'AppBundle\\Controller\\MessageController:sendMessageToUser',));
            }

        }

        elseif (0 === strpos($pathinfo, '/admin/user')) {
            // message_show_user_one
            if (preg_match('#^/admin/user/(?P<uid>[^/]++)/message/view/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'message_show_user_one')), array (  '_controller' => 'AppBundle\\Controller\\MessageController:showUserMessage',));
            }

            // admin_user_new
            if ('/admin/user/new' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::newuser',  '_route' => 'admin_user_new',);
            }

            // admin_user_search
            if ('/admin/user/search' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\UserController::UserSearch',  '_route' => 'admin_user_search',);
            }

            // users_editone
            if (preg_match('#^/admin/user/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'users_editone')), array (  '_controller' => 'AppBundle\\Controller\\UserController:showone',));
            }

            // user_admin
            if (0 === strpos($pathinfo, '/admin/user/edit') && preg_match('#^/admin/user/edit/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_admin')), array (  '_controller' => 'AppBundle\\Controller\\UserController:editone',));
            }

            // user_delete
            if (0 === strpos($pathinfo, '/admin/user/delete') && preg_match('#^/admin/user/delete/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_delete')), array (  '_controller' => 'AppBundle\\Controller\\UserController:deleteuser',));
            }

        }

        // user_edit
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/user/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_edit')), array (  '_controller' => 'AppBundle\\Controller\\UserController:showuser',));
        }

        // user_editdetail
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/useredit/(?P<uid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_editdetail')), array (  '_controller' => 'AppBundle\\Controller\\UserController:edituser',));
        }

        // user_viewmessage
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/user/(?P<uid>[^/]++)/viewmessage/(?P<mid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_viewmessage')), array (  '_controller' => 'AppBundle\\Controller\\UserController:viewmessage',));
        }

        // user_message_delete
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/user/(?P<uid>[^/]++)/message/delete/(?P<mid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_message_delete')), array (  '_controller' => 'AppBundle\\Controller\\UserController:deletemessage',));
        }

        // search_all
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/search/all$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'search_all')), array (  '_controller' => 'AppBundle\\Controller\\SearchController::ShowAll',));
        }

        if (0 === strpos($pathinfo, '/admin')) {
            // bookmarkdelete
            if (0 === strpos($pathinfo, '/admin/bookmark/delete') && preg_match('#^/admin/bookmark/delete/(?P<blt>[^/]++)/(?P<key>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'bookmarkdelete')), array (  '_controller' => 'AppBundle\\Controller\\BookmarkController::delete',));
            }

            // admin_bookmark_edit
            if ('/admin/bookmark/edit' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\BookmarkController::Edit',  '_route' => 'admin_bookmark_edit',);
            }

            if (0 === strpos($pathinfo, '/admin/person')) {
                // Person_new
                if ('/admin/person/register' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::register',  '_route' => 'Person_new',);
                }

                // admin_Person_edit_detail
                if (0 === strpos($pathinfo, '/admin/person/detail') && preg_match('#^/admin/person/detail/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_edit_detail')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::edit',));
                }

                // admin_Person_one
                if (preg_match('#^/admin/person/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_one')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::Editone',));
                }

                if (0 === strpos($pathinfo, '/admin/person/add')) {
                    // admin_Person_addevent
                    if (0 === strpos($pathinfo, '/admin/person/addevent') && preg_match('#^/admin/person/addevent/(?P<pid>[^/]++)/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_addevent')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::addevent',));
                    }

                    // admin_Person_addimage
                    if (0 === strpos($pathinfo, '/admin/person/addimage') && preg_match('#^/admin/person/addimage/(?P<pid>[^/]++)/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_addimage')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::addimage',));
                    }

                    // admin_Person_addcontent
                    if (0 === strpos($pathinfo, '/admin/person/addcontent') && preg_match('#^/admin/person/addcontent/(?P<pid>[^/]++)/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_addcontent')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::addcontent',));
                    }

                    // admin_Person_addlocation
                    if (0 === strpos($pathinfo, '/admin/person/addlocation') && preg_match('#^/admin/person/addlocation/(?P<pid>[^/]++)/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_addlocation')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::addlocation',));
                    }

                    // admin_Person_bookmark
                    if (0 === strpos($pathinfo, '/admin/person/addbookmark') && preg_match('#^/admin/person/addbookmark/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::addbookmark',));
                    }

                }

                // admin_Person_removeimage
                if (0 === strpos($pathinfo, '/admin/person/removeimage') && preg_match('#^/admin/person/removeimage/(?P<pid>[^/]++)/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_Person_removeimage')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::removeimage',));
                }

            }

        }

        // user_Person_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/person/addbookmark/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_Person_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\PersonController::addUserbookmark',));
        }

        // removeparticipation
        if (0 === strpos($pathinfo, '/admin/person/delete') && preg_match('#^/admin/person/delete/(?P<pid>[^/]++)/(?P<partid>\\d+)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'removeparticipation')), array (  '_controller' => 'AppBundle\\Controller\\AdminPersonController::deleteAction',));
        }

        // Person_all_locale
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/person/all$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'Person_all_locale')), array (  '_controller' => 'AppBundle\\Controller\\PersonController::Showall',));
        }

        // Person_one_locale
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/person/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'Person_one_locale')), array (  '_controller' => 'AppBundle\\Controller\\PersonController::Showone',));
        }

        // Person_pdf_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/person/pdf/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'Person_pdf_one')), array (  '_controller' => 'AppBundle\\Controller\\PersonController::pdfone',));
        }

        // participants_all
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/participant/all$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'participants_all')), array (  '_controller' => 'AppBundle\\Controller\\ParticipantController::Showall',));
        }

        // participants_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/participant/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'participants_one')), array (  '_controller' => 'AppBundle\\Controller\\ParticipantController::Showone',));
        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/participant')) {
                // admin_participants_editone
                if (0 === strpos($pathinfo, '/admin/participant/detail') && preg_match('#^/admin/participant/detail/(?P<ptid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_participants_editone')), array (  '_controller' => 'AppBundle\\Controller\\ParticipantController::edit',));
                }

                // admin_participants_edit
                if (preg_match('#^/admin/participant/(?P<ptid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_participants_edit')), array (  '_controller' => 'AppBundle\\Controller\\ParticipantController::edit',));
                }

                // participants_add_person
                if (0 === strpos($pathinfo, '/admin/participant/add') && preg_match('#^/admin/participant/add/(?P<eid>[^/]++)/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'participants_add_person')), array (  '_controller' => 'AppBundle\\Controller\\ParticipantController::addparticipant',));
                }

            }

            // admin_participant_person
            if (0 === strpos($pathinfo, '/admin/participations/editperson') && preg_match('#^/admin/participations/editperson/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_participant_person')), array (  '_controller' => 'AppBundle\\Controller\\ParticipantController::EditPerson',));
            }

            if (0 === strpos($pathinfo, '/admin/text')) {
                // admin_text_edit
                if (preg_match('#^/admin/text/(?P<objecttype>[^/]++)/(?P<objid>[^/]++)/(?P<attribute>[^/]++)/(?P<language>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_text_edit')), array (  '_controller' => 'AppBundle\\Controller\\TextController::editone',));
                }

                // text_person_admin
                if (0 === strpos($pathinfo, '/admin/text/person') && preg_match('#^/admin/text/person/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'text_person_admin')), array (  '_controller' => 'AppBundle\\Controller\\TextController::editperson',));
                }

                // admin_text_event
                if (0 === strpos($pathinfo, '/admin/text/event') && preg_match('#^/admin/text/event/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_text_event')), array (  '_controller' => 'AppBundle\\Controller\\TextController::editevent',));
                }

                // admin_text_image
                if (0 === strpos($pathinfo, '/admin/text/image') && preg_match('#^/admin/text/image/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_text_image')), array (  '_controller' => 'AppBundle\\Controller\\TextController::editimage',));
                }

                // admin_text_reflink
                if (0 === strpos($pathinfo, '/admin/text/reflink') && preg_match('#^/admin/text/reflink/(?P<rfid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_text_reflink')), array (  '_controller' => 'AppBundle\\Controller\\TextController::editreflink',));
                }

                // texts_edit_group
                if (preg_match('#^/admin/text/(?P<objecttype>[^/]++)/(?P<objid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'texts_edit_group')), array (  '_controller' => 'AppBundle\\Controller\\TextController::editgroup',));
                }

            }

            // admin_image_asearch
            if ('/admin/image/search' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ImageController::Adminsearch',  '_route' => 'admin_image_asearch',);
            }

        }

        // texts_all
        if ('/text/all' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\TextController::Showall',  '_route' => 'texts_all',);
        }

        // texts_group
        if ('/text/group' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\TextController::Showgroup',  '_route' => 'texts_group',);
        }

        // user_image_all
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/image/all$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_image_all')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::Showall',));
        }

        // user_image_one
        if (preg_match('#^/(?P<_locale>en|fr|EN|FR)/image/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_image_one')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::Showone',));
        }

        if (0 === strpos($pathinfo, '/admin/image')) {
            // admin_image_addbookmark
            if (0 === strpos($pathinfo, '/admin/image/addBookmark') && preg_match('#^/admin/image/addBookmark/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_image_addbookmark')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::addbookmark',));
            }

            // admin_image_addref
            if (0 === strpos($pathinfo, '/admin/image/addref') && preg_match('#^/admin/image/addref/(?P<otype>[^/]++)/(?P<oid>[^/]++)/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_image_addref')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::addref',));
            }

            // admin_image_new
            if ('/admin/image/new' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ImageController::newimage',  '_route' => 'admin_image_new',);
            }

            // admin_image_showone
            if (preg_match('#^/admin/image/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_image_showone')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::editone',));
            }

            // admin_image_edit
            if (0 === strpos($pathinfo, '/admin/image/edit') && preg_match('#^/admin/image/edit/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_image_edit')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::edit',));
            }

            // admin_image_bookmark
            if (0 === strpos($pathinfo, '/admin/image/bookmark') && preg_match('#^/admin/image/bookmark/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_image_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::addBookmark',));
            }

        }

        // user_image_bookmark
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/image/addbookmark/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_image_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\ImageController::addUserbookmark',));
        }

        // events_admin_top
        if ('/admin/event/top' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::Showtop',  '_route' => 'events_admin_top',);
        }

        // events_admin_addbookmark
        if (0 === strpos($pathinfo, '/admin/event/addbookmark') && preg_match('#^/admin/event/addbookmark/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_admin_addbookmark')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::addBookmark',));
        }

        // events_user_addbookmark
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/event/addbookmark/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_user_addbookmark')), array (  '_controller' => 'AppBundle\\Controller\\EventController::addBookmark',));
        }

        if (0 === strpos($pathinfo, '/admin/event')) {
            if (0 === strpos($pathinfo, '/admin/event/add')) {
                // events_admin_addimage
                if (0 === strpos($pathinfo, '/admin/event/addimage') && preg_match('#^/admin/event/addimage/(?P<eid>[^/]++)/(?P<iid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_admin_addimage')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::addImage',));
                }

                // events_admin_addparticipant
                if (0 === strpos($pathinfo, '/admin/event/addparticipant') && preg_match('#^/admin/event/addparticipant/(?P<eid>[^/]++)/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_admin_addparticipant')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::addparticipant',));
                }

                // events_admin_addcontent
                if (0 === strpos($pathinfo, '/admin/event/addcontent') && preg_match('#^/admin/event/addcontent/(?P<eid>[^/]++)/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_admin_addcontent')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::addcontent',));
                }

            }

            // event_admin_removeimage
            if (0 === strpos($pathinfo, '/admin/event/removeimage') && preg_match('#^/admin/event/removeimage/(?P<eid>[^/]++)/(?P<irid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'event_admin_removeimage')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::removeImageRef',));
            }

            // event_admin_setlocation
            if (0 === strpos($pathinfo, '/admin/event/setlocation') && preg_match('#^/admin/event/setlocation/(?P<eid>[^/]++)/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'event_admin_setlocation')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::setLocation',));
            }

            // events_admin_participants
            if (0 === strpos($pathinfo, '/admin/event/participant') && preg_match('#^/admin/event/participant/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_admin_participants')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::Editparticipants',));
            }

        }

        // events_all
        if (preg_match('#^/(?P<_locale>[^/]++)/event/all$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_all')), array (  '_controller' => 'AppBundle\\Controller\\EventController::Showall',));
        }

        // events_top_locale
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/event/top$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_top_locale')), array (  '_controller' => 'AppBundle\\Controller\\EventController::Showtop',));
        }

        // events_top
        if (preg_match('#^/(?P<_locale>[^/]++)/event/top$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_top')), array (  '_controller' => 'AppBundle\\Controller\\EventController::Showtop',));
        }

        // events_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/event/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_one')), array (  '_controller' => 'AppBundle\\Controller\\EventController::Showone',));
        }

        if (0 === strpos($pathinfo, '/admin/event')) {
            // admin_events_one
            if (preg_match('#^/admin/event/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_events_one')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::Editone',));
            }

            // admin_event_one
            if (preg_match('#^/admin/event/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_event_one')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::Editone',));
            }

            // admin_events_detail
            if (0 === strpos($pathinfo, '/admin/event/detail') && preg_match('#^/admin/event/detail/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_events_detail')), array (  '_controller' => 'AppBundle\\Controller\\AdminEventController::Editdetail',));
            }

        }

        // incident_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/incident/(?P<inid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'incident_one')), array (  '_controller' => 'AppBundle\\Controller\\IncidentController::Showone',));
        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/incident')) {
                // admin_incidents_all
                if ('/admin/incident/all' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\IncidentController::Showall',  '_route' => 'admin_incidents_all',);
                }

                // admin_incident_new
                if (0 === strpos($pathinfo, '/admin/incident/new') && preg_match('#^/admin/incident/new/(?P<eid>[^/]++)/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_incident_new')), array (  '_controller' => 'AppBundle\\Controller\\IncidentController::new',));
                }

                // admin_incidents_edit
                if (preg_match('#^/admin/incident/(?P<inid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_incidents_edit')), array (  '_controller' => 'AppBundle\\Controller\\IncidentController::edit',));
                }

                // admin_incident_delete
                if (0 === strpos($pathinfo, '/admin/incident/delete') && preg_match('#^/admin/incident/delete/(?P<inid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_incident_delete')), array (  '_controller' => 'AppBundle\\Controller\\IncidentController::delete',));
                }

            }

            // admin_location_upload
            if (0 === strpos($pathinfo, '/admin/location/upload') && preg_match('#^/admin/location/upload/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_location_upload')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::upload',));
            }

            // admin_location_bookmark
            if (0 === strpos($pathinfo, '/admin/location/addbookmark') && preg_match('#^/admin/location/addbookmark/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_location_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::addbookmark',));
            }

        }

        // location_top
        if ('/location/top' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\LocationController::Showtop',  '_route' => 'location_top',);
        }

        // location_all
        if ('/location/all' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\LocationController::Showall',  '_route' => 'location_all',);
        }

        // user_location_bookmark
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/location/addbookmark/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_location_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::addUserbookmark',));
        }

        if (0 === strpos($pathinfo, '/admin/location')) {
            // admin_location_top
            if ('/admin/location/top' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\LocationController::Edittop',  '_route' => 'admin_location_top',);
            }

            // admin_location_editone
            if (preg_match('#^/admin/location/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_location_editone')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::Editone',));
            }

            if (0 === strpos($pathinfo, '/admin/location/detail')) {
                // location_new
                if (0 === strpos($pathinfo, '/admin/location/detail/new') && preg_match('#^/admin/location/detail/new/(?P<rid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'location_new')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::New',));
                }

                // admin_location_edit_detail
                if (preg_match('#^/admin/location/detail/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_location_edit_detail')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::Edit',));
                }

            }

        }

        // location_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/location/(?P<lid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'location_one')), array (  '_controller' => 'AppBundle\\Controller\\LocationController::Showone',));
        }

        if (0 === strpos($pathinfo, '/admin/linkref')) {
            // linkref_all
            if ('/admin/linkref/all' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::Showall',  '_route' => 'linkref_all',);
            }

            // linkref_edit_detail
            if (0 === strpos($pathinfo, '/admin/linkref/edit') && preg_match('#^/admin/linkref/edit/(?P<ot>[^/]++)/(?P<oid>[^/]++)/(?P<lrid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_edit_detail')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::Edit',));
            }

            // linkref_delete_one
            if (0 === strpos($pathinfo, '/admin/linkref/delete') && preg_match('#^/admin/linkref/delete/(?P<ot>[^/]++)/(?P<oid>[^/]++)/(?P<lrid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_delete_one')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::Delete',));
            }

            // linkref_edit
            if (preg_match('#^/admin/linkref/(?P<ot>[^/]++)/(?P<oid>[^/]++)/(?P<lrid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_edit')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::Editone',));
            }

            // linkref_edit_person_group
            if (0 === strpos($pathinfo, '/admin/linkref/editperson') && preg_match('#^/admin/linkref/editperson/(?P<pid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_edit_person_group')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::EditpersonGroup',));
            }

            // linkref_edit_event_group
            if (0 === strpos($pathinfo, '/admin/linkref/editevent') && preg_match('#^/admin/linkref/editevent/(?P<eid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_edit_event_group')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::EditeventGroup',));
            }

        }

        // linkref_add
        if (0 === strpos($pathinfo, '/admin/addref') && preg_match('#^/admin/addref/(?P<otype1>[^/]++)/(?P<oid1>[^/]++)/(?P<otype2>[^/]++)/(?P<oid2>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_add')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::Addlink',));
        }

        // linkref_one
        if (0 === strpos($pathinfo, '/linkref') && preg_match('#^/linkref/(?P<rid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'linkref_one')), array (  '_controller' => 'AppBundle\\Controller\\LinkrefController::Showone',));
        }

        // content_all
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/content/all$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'content_all')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Showall',));
        }

        // content_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/content/(?P<sid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'content_one')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Showsubject',));
        }

        // content_menu
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/menucontent/(?P<sid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'content_menu')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Showsubject',));
        }

        // subject_one
        if (preg_match('#^/(?P<_locale>en|fr|FR|EN)/contentid/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'subject_one')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Showcontent',));
        }

        if (0 === strpos($pathinfo, '/admin/content')) {
            // admin_content_search
            if ('/admin/content/search' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ContentController::ContentSearch',  '_route' => 'admin_content_search',);
            }

            // admin_content_edit
            if (0 === strpos($pathinfo, '/admin/content/edit') && preg_match('#^/admin/content/edit/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_edit')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Edit',));
            }

            // admin_content_newt
            if ('/admin/content/new' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\ContentController::Editnew',  '_route' => 'admin_content_newt',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_admin_content_newt;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'admin_content_newt'));
                }

                return $ret;
            }
            not_admin_content_newt:

            // admin_content_delete
            if (0 === strpos($pathinfo, '/admin/content/delete') && preg_match('#^/admin/content/delete/(?P<cid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_delete')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Delete',));
            }

            // admin_content_bookmark
            if (0 === strpos($pathinfo, '/admin/content/addbookmark') && preg_match('#^/admin/content/addbookmark/(?P<sid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::addBookmark',));
            }

        }

        // user_content_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/content/addbookmark/(?P<sid>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_content_bookmark')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::addUserBookmark',));
        }

        if (0 === strpos($pathinfo, '/admin/content')) {
            // admin_content_editone
            if (preg_match('#^/admin/content/(?P<sid>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_editone')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Editsubject',));
            }

            // admin_content_new
            if (0 === strpos($pathinfo, '/admin/content/edit') && preg_match('#^/admin/content/edit/(?P<sid>[^/]++)/(?P<lang>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_new')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Newlang',));
            }

            // admin_content_deleteimage
            if (0 === strpos($pathinfo, '/admin/content/deleteimage') && preg_match('#^/admin/content/deleteimage/(?P<cid>[^/]++)/(?P<isn>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_content_deleteimage')), array (  '_controller' => 'AppBundle\\Controller\\ContentController::Deleteimage',));
            }

        }

        // catch_all
        if (preg_match('#^/(?P<catch_all>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'catch_all')), array (  '_controller' => 'AppBundle\\Controller\\AccueilController::Showall',));
        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
