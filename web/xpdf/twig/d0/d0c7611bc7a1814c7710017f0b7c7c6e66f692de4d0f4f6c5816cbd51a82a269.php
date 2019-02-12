<?php

/* base.html.twig */
class __TwigTemplate_28c4c6f478e30b9413debf1bb27a48289c176c7e830fca8495c05857912c5931 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'js' => array($this, 'block_js'),
            'myheader' => array($this, 'block_myheader'),
            'mypage' => array($this, 'block_mypage'),
            'main_menu' => array($this, 'block_main_menu'),
            'left' => array($this, 'block_left'),
            'sidebar' => array($this, 'block_sidebar'),
            'middle' => array($this, 'block_middle'),
            'right' => array($this, 'block_right'),
            'myfooter' => array($this, 'block_myfooter'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "
<html><head><meta charset=\"UTF-8\">
<link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
<link rel=\"shortcut\" type=\"image/x-icon\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        ";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        // line 6
        echo "        ";
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 10
        echo "        ";
        $this->displayBlock('js', $context, $blocks);
        // line 14
        echo "       
      
    </head>
    <body>
        <div id=\"page\" >
          <div class='header' id='header' >
          ";
        // line 20
        $this->displayBlock('myheader', $context, $blocks);
        // line 85
        echo "          </div>
        
          <div class='mypage'>    
           <div class='mypageinner'>   
          ";
        // line 89
        $this->displayBlock('mypage', $context, $blocks);
        // line 126
        echo "
 
     <div id=\"footer\">
      ";
        // line 129
        $this->displayBlock('myfooter', $context, $blocks);
        // line 145
        echo "  
     </div>
   </div>
   
  </body>      
 
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "<title>";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("bienvenue.site"), "html", null, true);
        echo "</title>";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 7
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
            <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/header/header.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 10
    public function block_js($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "js"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "js"));

        // line 11
        echo "           <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/main.js"), "html", null, true);
        echo "\"></script>
           <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/frbookmarks.js"), "html", null, true);
        echo "\"></script>
        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 20
    public function block_myheader($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "myheader"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "myheader"));

        // line 21
        echo "          
            <table  >
              <tr>
               <td class=\"logo1\" rowspan=\"2\">
                 <img src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("common/lorraineflag.gif"), "html", null, true);
        echo "\"  width=\"100\" border=\"0\" />
               </td>
               <td class=\"centertext\" >
                  <p class=\"headertext1\"> Parachutistes S.A.S de la France Libre 1940 - 1945</p>
                  <p class=\"headertext2\"> Special Air Service 1st SAS - 3rd SAS - 4th SAS </p>
                  <p class=\"headertext3\"> Chasseurs Parachutistes 1ère CCP - 2ème RCP - 3ème RCP </p>
                </td>          
                <td class=\"logo2\" rowspan=\"2\">
                   <img src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("common/wings_tr.png"), "html", null, true);
        echo "\" alt=\"\" width=\"150\" border=\"0\" />
                </td>
              </tr>
              <tr>
                <td class=\"bottomtext\">
                  <p class=\"headertext4\"> -La liberté tombée du ciel-</p>
                </td>
              </tr>  
            </table>
            <div class=\"messagebar\" >
              ";
        // line 43
        $context["locale"] = $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "getLocale", array(), "method");
        // line 44
        echo "              ";
        $context["cpath"] = $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "uri", array());
        // line 45
        echo "            ";
        if (twig_in_filter("en", twig_lower_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale"))))) {
            // line 46
            echo "                ";
            $context["cpath"] = twig_replace_filter(($context["cpath"] ?? $this->getContext($context, "cpath")), array("/en/" => "/fr/"));
            // line 47
            echo "               <div class=\"languagelink\"><a href=";
            echo twig_escape_filter($this->env, ($context["cpath"] ?? $this->getContext($context, "cpath")), "html", null, true);
            echo "  ><img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("common/fr.gif"), "html", null, true);
            echo "\"/></a></div>
            ";
        } else {
            // line 49
            echo "             ";
            $context["cpath"] = twig_replace_filter(($context["cpath"] ?? $this->getContext($context, "cpath")), array("/fr/" => "/en/"));
            // line 50
            echo "               ";
            $context["cpath"] = twig_replace_filter(($context["cpath"] ?? $this->getContext($context, "cpath")), array("/FR/" => "/en/"));
            // line 51
            echo "               <div class=\"languagelink\"><a href =";
            echo twig_escape_filter($this->env, ($context["cpath"] ?? $this->getContext($context, "cpath")), "html", null, true);
            echo " ><img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("common/en.gif"), "html", null, true);
            echo "\" /></a></div>
            ";
        }
        // line 53
        echo "               <div class=\"welcome\">
               ";
        // line 54
        if ((null === $this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "user", array()))) {
            // line 55
            echo "              ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("bienvenue.visiteur"), "html", null, true);
            echo "
               ";
        } else {
            // line 57
            echo "                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("bienvenue"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "
                    (";
            // line 58
            if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
                echo " Administrator";
            }
            // line 59
            echo "                    ";
            if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
                echo " User";
            }
            echo " )
               ";
        }
        // line 61
        echo "               </div>
               <div class=\"status\">
               [";
        // line 63
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "] FFLSAS3
               </div>
               <div class=\"filler\"></div>
                ";
        // line 66
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_TEMP")) {
            // line 67
            echo "                <div class=\"complete messbutton\">
                     <a href=\"/";
            // line 68
            echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
            echo "/complete/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "user", array()), "userid", array()), "html", null, true);
            echo "\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("complete.reg"), "html", null, true);
            echo "</a>
                </div>
                ";
        }
        // line 71
        echo "                ";
        if ((null === $this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "user", array()))) {
            // line 72
            echo "                <div class=\"loginlink messbutton\">
                     <a href=\"/";
            // line 73
            echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
            echo "/login\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("log.in"), "html", null, true);
            echo "</a>
                </div>
                ";
        } else {
            // line 76
            echo "                  <div class=\"logoutlink messbutton\">
                     <a href=\"/logout\"  >";
            // line 77
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("log.out"), "html", null, true);
            echo "</a>
                </div>                
                ";
        }
        // line 80
        echo "                 <div class=\"contactlink messbutton\">
                     <a href=\"/";
        // line 81
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/mailto\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("mail.us"), "html", null, true);
        echo "</a>
                </div>
            </div>
          ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 89
    public function block_mypage($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "mypage"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "mypage"));

        // line 90
        echo "
         ";
        // line 94
        echo "   
           <div id=\"left\" >
          ";
        // line 96
        $this->displayBlock('main_menu', $context, $blocks);
        // line 99
        echo "          ";
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("AppBundle\\Controller\\PersonController::showsidebar"));
        echo " 
          ";
        // line 100
        $this->displayBlock('left', $context, $blocks);
        // line 105
        echo "         </div>
         <div id=\"middle\" >
          ";
        // line 107
        $this->displayBlock('middle', $context, $blocks);
        // line 110
        echo "         </div>
         <div id=\"right\" >
         ";
        // line 112
        $this->displayBlock('right', $context, $blocks);
        // line 120
        echo "          </div>
        </div>
        </div>
  ";
        // line 125
        echo "  ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 96
    public function block_main_menu($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_menu"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_menu"));

        // line 97
        echo "             ";
        $this->loadTemplate("main_menu.html.twig", "base.html.twig", 97)->display($context);
        // line 98
        echo "          ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 100
    public function block_left($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "left"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "left"));

        // line 101
        echo "            ";
        $this->displayBlock('sidebar', $context, $blocks);
        // line 104
        echo "         ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 101
    public function block_sidebar($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sidebar"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sidebar"));

        // line 102
        echo "               <div><p> </p></div>
            ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 107
    public function block_middle($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "middle"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "middle"));

        // line 108
        echo "            <div><p> </p></div>
          ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 112
    public function block_right($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "right"));

        // line 113
        echo "            <div> <p> </p></div>
           
             ";
        // line 115
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 116
            echo " ";
            echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("AppBundle\\Controller\\BookmarkController::setfield"));
            echo "
 ";
        }
        // line 118
        echo " ";
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment(Symfony\Bridge\Twig\Extension\HttpKernelExtension::controller("AppBundle\\Controller\\RandomimageController::randomimage"));
        echo "
          ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 129
    public function block_myfooter($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "myfooter"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "myfooter"));

        // line 130
        echo "        ";
        $context["locale"] = twig_lower_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "getLocale", array(), "method"));
        // line 131
        echo "      <table>
         <tr>
           <td class='left' >
             <div class=\"menuitem\" > <a href=\"/";
        // line 134
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/menucontent/204\"> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.copyright", array(), "messages");
        echo "</a> </div>
           </td>
           <td class='center' >
             <h1 > FFLSAS &copy;</h1>
           </td>
           <td  class='right'> 
           
              <div class=\"menuitem\" > <a href=\"/";
        // line 141
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/menucontent/194\"> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.privacy", array(), "messages");
        echo "</a> </div>
           </td>
         </tr>
      </table>
      ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  538 => 141,  526 => 134,  521 => 131,  518 => 130,  509 => 129,  496 => 118,  490 => 116,  488 => 115,  484 => 113,  475 => 112,  464 => 108,  455 => 107,  444 => 102,  435 => 101,  425 => 104,  422 => 101,  413 => 100,  403 => 98,  400 => 97,  391 => 96,  381 => 125,  376 => 120,  374 => 112,  370 => 110,  368 => 107,  364 => 105,  362 => 100,  357 => 99,  355 => 96,  351 => 94,  348 => 90,  339 => 89,  323 => 81,  320 => 80,  314 => 77,  311 => 76,  303 => 73,  300 => 72,  297 => 71,  287 => 68,  284 => 67,  282 => 66,  276 => 63,  272 => 61,  264 => 59,  260 => 58,  253 => 57,  247 => 55,  245 => 54,  242 => 53,  234 => 51,  231 => 50,  228 => 49,  220 => 47,  217 => 46,  214 => 45,  211 => 44,  209 => 43,  196 => 33,  185 => 25,  179 => 21,  170 => 20,  158 => 12,  153 => 11,  144 => 10,  132 => 8,  127 => 7,  118 => 6,  98 => 5,  81 => 145,  79 => 129,  74 => 126,  72 => 89,  66 => 85,  64 => 20,  56 => 14,  53 => 10,  50 => 6,  48 => 5,  44 => 4,  40 => 3,  36 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
<html><head><meta charset=\"UTF-8\">
<link rel=\"icon\" type=\"image/x-icon\" href=\"{{asset('favicon.ico')}}\" />
<link rel=\"shortcut\" type=\"image/x-icon\" href=\"{{asset('favicon.ico')}}\" />
        {% block title %}<title>{{ 'bienvenue.site' | trans }}</title>{% endblock %}
        {% block stylesheets %}
            <link href=\"{{ asset('css/main.css') }}\" rel=\"stylesheet\" />
            <link href=\"{{ asset('css/header/header.css') }}\" rel=\"stylesheet\" />
        {% endblock %}
        {% block js %}
           <script src=\"{{asset('js/main.js')}}\"></script>
           <script src=\"{{asset('js/frbookmarks.js')}}\"></script>
        {% endblock %}
       
      
    </head>
    <body>
        <div id=\"page\" >
          <div class='header' id='header' >
          {% block myheader %}
          
            <table  >
              <tr>
               <td class=\"logo1\" rowspan=\"2\">
                 <img src=\"{{ asset('common/lorraineflag.gif') }}\"  width=\"100\" border=\"0\" />
               </td>
               <td class=\"centertext\" >
                  <p class=\"headertext1\"> Parachutistes S.A.S de la France Libre 1940 - 1945</p>
                  <p class=\"headertext2\"> Special Air Service 1st SAS - 3rd SAS - 4th SAS </p>
                  <p class=\"headertext3\"> Chasseurs Parachutistes 1ère CCP - 2ème RCP - 3ème RCP </p>
                </td>          
                <td class=\"logo2\" rowspan=\"2\">
                   <img src=\"{{ asset('common/wings_tr.png') }}\" alt=\"\" width=\"150\" border=\"0\" />
                </td>
              </tr>
              <tr>
                <td class=\"bottomtext\">
                  <p class=\"headertext4\"> -La liberté tombée du ciel-</p>
                </td>
              </tr>  
            </table>
            <div class=\"messagebar\" >
              {% set locale =  app.request.getLocale() %}
              {% set cpath = app.request.uri %}
            {% if 'en' in ( locale | lower ) %}
                {% set cpath  = (cpath | replace({'/en/' :'/fr/'}) ) %}
               <div class=\"languagelink\"><a href={{cpath}}  ><img src=\"{{asset('common/fr.gif')}}\"/></a></div>
            {% else %}
             {% set cpath  = (cpath | replace({'/fr/' :'/en/'}) ) %}
               {% set cpath  = (cpath | replace({'/FR/' :'/en/'}) ) %}
               <div class=\"languagelink\"><a href ={{cpath}} ><img src=\"{{asset('common/en.gif')}}\" /></a></div>
            {% endif %}
               <div class=\"welcome\">
               {% if app.user  is null %}
              {{ 'bienvenue.visiteur' | trans }}
               {% else %}
                    {{ 'bienvenue' | trans }} {{ app.user.username }}
                    ({% if is_granted('ROLE_ADMIN') %} Administrator{% endif %}
                    {% if is_granted('ROLE_USER') %} User{% endif %} )
               {% endif %}
               </div>
               <div class=\"status\">
               [{{locale}}] FFLSAS3
               </div>
               <div class=\"filler\"></div>
                {% if is_granted('ROLE_TEMP') %}
                <div class=\"complete messbutton\">
                     <a href=\"/{{locale}}/complete/{{ app.user.userid }}\" >{{ \"complete.reg\" | trans}}</a>
                </div>
                {% endif %}
                {% if app.user  is null%}
                <div class=\"loginlink messbutton\">
                     <a href=\"/{{locale}}/login\" >{{ \"log.in\" | trans}}</a>
                </div>
                {% else %}
                  <div class=\"logoutlink messbutton\">
                     <a href=\"/logout\"  >{{ \"log.out\" | trans}}</a>
                </div>                
                {% endif %}
                 <div class=\"contactlink messbutton\">
                     <a href=\"/{{locale}}/mailto\" >{{ \"mail.us\" | trans}}</a>
                </div>
            </div>
          {% endblock %}
          </div>
        
          <div class='mypage'>    
           <div class='mypageinner'>   
          {% block mypage %}

         {# <div id='container3'>
         <div id='container2'>
         <div id='container1'>#}
   
           <div id=\"left\" >
          {% block main_menu %}
             {% include 'main_menu.html.twig' %}
          {% endblock %}
          {{ render(controller('AppBundle\\\\Controller\\\\PersonController::showsidebar')) }} 
          {% block left %}
            {% block sidebar %}
               <div><p> </p></div>
            {% endblock %}
         {% endblock %}
         </div>
         <div id=\"middle\" >
          {% block middle %}
            <div><p> </p></div>
          {% endblock %}
         </div>
         <div id=\"right\" >
         {% block right %}
            <div> <p> </p></div>
           
             {% if is_granted('ROLE_USER') %}
 {{ render(controller('AppBundle\\\\Controller\\\\BookmarkController::setfield'))}}
 {% endif %}
 {{ render(controller('AppBundle\\\\Controller\\\\RandomimageController::randomimage')) }}
          {% endblock %}
          </div>
        </div>
        </div>
  {#  </div>
    </div> #}
  {% endblock %}

 
     <div id=\"footer\">
      {% block myfooter %}
        {% set locale =  app.request.getLocale() | lower %}
      <table>
         <tr>
           <td class='left' >
             <div class=\"menuitem\" > <a href=\"/{{locale}}/menucontent/204\"> {% trans %}admin.copyright{% endtrans %}</a> </div>
           </td>
           <td class='center' >
             <h1 > FFLSAS &copy;</h1>
           </td>
           <td  class='right'> 
           
              <div class=\"menuitem\" > <a href=\"/{{locale}}/menucontent/194\"> {% trans %}admin.privacy{% endtrans %}</a> </div>
           </td>
         </tr>
      </table>
      {% endblock %}  
     </div>
   </div>
   
  </body>      
 
</html>
", "base.html.twig", "/home/paul/symfony3/syfflsas3/app/Resources/views/base.html.twig");
    }
}
