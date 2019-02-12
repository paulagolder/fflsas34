<?php

/* main_menu.html.twig */
class __TwigTemplate_f8d27705fcd3e821e21ccacbef7def904bde504c67b7fea7ffca3580d59d32c4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "main_menu.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "main_menu.html.twig"));

        // line 1
        echo "
            ";
        // line 2
        $context["locale"] = twig_lower_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "getLocale", array(), "method"));
        // line 3
        echo "<div id=\"mainmenu\">
 <div class=\"menuitem\" > <a  href=\"/";
        // line 4
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/menucontent/201\"> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("introduction", array(), "messages");
        echo "</a></div>
  <div class=\"menuitem\" > <a  href=\"/";
        // line 5
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/menucontent/200\"> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("notre.site", array(), "messages");
        echo "</a></div>
 <div class=\"menuitem\" > <a  href=\"/";
        // line 6
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/person/all\"> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("les.hommes", array(), "messages");
        echo "</a></div>
 <div class=\"menuitem\" > <a href=\"/";
        // line 7
        echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
        echo "/event/top\"> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("les.actions", array(), "messages");
        echo "</a> </div>

";
        // line 9
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 10
            echo "   <div class=\"menuitem\" > <a href=\"/";
            echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
            echo "/search/all\"> ";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("chercher.site", array(), "messages");
            echo "</a> </div>
   <div class=\"menuitem\" > <a href=\"/";
            // line 11
            echo twig_escape_filter($this->env, ($context["locale"] ?? $this->getContext($context, "locale")), "html", null, true);
            echo "/user/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "user", array()), "userid", array()), "html", null, true);
            echo "\"> ";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("voir.user", array(), "messages");
            echo "</a> </div>
";
        }
        // line 13
        echo " ";
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            echo "  
   <div class=\"menuitem\" > <a href=\"/admin/image/search\"> ";
            // line 14
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.images", array(), "messages");
            echo "</a> </div>
    <div class=\"menuitem\" > <a href=\"/admin/location/top\"> ";
            // line 15
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.locations", array(), "messages");
            echo "</a> </div>
      <div class=\"menuitem\" > <a href=\"/admin/content/search\"> ";
            // line 16
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.content", array(), "messages");
            echo "</a> </div>
      <div class=\"menuitem\" > <a href=\"/admin/user/search\"> ";
            // line 17
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.allusers", array(), "messages");
            echo "</a> </div>
      <div class=\"menuitem\" > <a href=\"/admin/message/all\"> ";
            // line 18
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("admin.messages", array(), "messages");
            echo "</a> </div>
";
        }
        // line 20
        echo "</div>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "main_menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 20,  97 => 18,  93 => 17,  89 => 16,  85 => 15,  81 => 14,  76 => 13,  67 => 11,  60 => 10,  58 => 9,  51 => 7,  45 => 6,  39 => 5,  33 => 4,  30 => 3,  28 => 2,  25 => 1,);
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
            {% set locale =  app.request.getLocale() | lower %}
<div id=\"mainmenu\">
 <div class=\"menuitem\" > <a  href=\"/{{locale}}/menucontent/201\"> {% trans %}introduction{% endtrans %}</a></div>
  <div class=\"menuitem\" > <a  href=\"/{{locale}}/menucontent/200\"> {% trans %}notre.site{% endtrans %}</a></div>
 <div class=\"menuitem\" > <a  href=\"/{{locale}}/person/all\"> {% trans %}les.hommes{% endtrans %}</a></div>
 <div class=\"menuitem\" > <a href=\"/{{locale}}/event/top\"> {% trans %}les.actions{% endtrans %}</a> </div>

{% if is_granted('ROLE_USER') %}
   <div class=\"menuitem\" > <a href=\"/{{locale}}/search/all\"> {% trans %}chercher.site{% endtrans %}</a> </div>
   <div class=\"menuitem\" > <a href=\"/{{locale}}/user/{{ app.user.userid }}\"> {% trans %}voir.user{% endtrans %}</a> </div>
{% endif %}
 {% if is_granted('ROLE_ADMIN') %}  
   <div class=\"menuitem\" > <a href=\"/admin/image/search\"> {% trans %}admin.images{% endtrans %}</a> </div>
    <div class=\"menuitem\" > <a href=\"/admin/location/top\"> {% trans %}admin.locations{% endtrans %}</a> </div>
      <div class=\"menuitem\" > <a href=\"/admin/content/search\"> {% trans %}admin.content{% endtrans %}</a> </div>
      <div class=\"menuitem\" > <a href=\"/admin/user/search\"> {% trans %}admin.allusers{% endtrans %}</a> </div>
      <div class=\"menuitem\" > <a href=\"/admin/message/all\"> {% trans %}admin.messages{% endtrans %}</a> </div>
{% endif %}
</div>
", "main_menu.html.twig", "/home/paul/symfony3/syfflsas3/app/Resources/views/main_menu.html.twig");
    }
}
