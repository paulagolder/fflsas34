<?php

/* randomimage/showone.html.twig */
class __TwigTemplate_4e986d59110b6833faaeb87ac01074f81a1ead2a1ed9f3fb44da8dce0eeec8cd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "randomimage/showone.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "randomimage/showone.html.twig"));

        // line 1
        echo "
";
        // line 2
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 5
        echo "

   ";
        // line 7
        if (($context["image"] ?? $this->getContext($context, "image"))) {
            // line 8
            echo "    <div id=\"randomimage\" class=\"frame\">
       <div class=\"heading\">
         <div class=\"label\" >";
            // line 10
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("image.chance", array(), "messages");
            echo "</div> 
       </div>
       <div class=\"image\"> 
        <a href=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute(($context["image"] ?? $this->getContext($context, "image")), "link", array()), "html", null, true);
            echo "\" > <img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["image"] ?? $this->getContext($context, "image")), "fullpath", array()), "html", null, true);
            echo "\" style =\"max-width:100%; max-height:100%;\" /></a>
      </div>
       <div class=\"subheading\">
        ";
            // line 16
            if ((isset($context["title"]) || array_key_exists("title", $context))) {
                // line 17
                echo "          <div class=\"title\">";
                echo twig_escape_filter($this->env, ($context["title"] ?? $this->getContext($context, "title")), "html", null, true);
                echo "</div> 
        ";
            } else {
                // line 19
                echo "          <div class=\"title\">Title Not found</div> 
        ";
            }
            // line 21
            echo "      
       </div>
   </div>
  ";
        }
        // line 25
        echo "
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 3
        echo "   <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/randomimage/showone.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "randomimage/showone.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 3,  84 => 2,  73 => 25,  67 => 21,  63 => 19,  57 => 17,  55 => 16,  47 => 13,  41 => 10,  37 => 8,  35 => 7,  31 => 5,  29 => 2,  26 => 1,);
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
{% block stylesheets %}
   <link href=\"{{ asset('css/randomimage/showone.css') }}\" rel=\"stylesheet\" />
{% endblock %}


   {% if image %}
    <div id=\"randomimage\" class=\"frame\">
       <div class=\"heading\">
         <div class=\"label\" >{% trans %}image.chance{% endtrans %}</div> 
       </div>
       <div class=\"image\"> 
        <a href=\"{{image.link}}\" > <img src=\"{{ image.fullpath }}\" style =\"max-width:100%; max-height:100%;\" /></a>
      </div>
       <div class=\"subheading\">
        {% if title is defined %}
          <div class=\"title\">{{title}}</div> 
        {% else %}
          <div class=\"title\">Title Not found</div> 
        {% endif %}
      
       </div>
   </div>
  {% endif %}

", "randomimage/showone.html.twig", "/home/paul/symfony3/syfflsas3/app/Resources/views/randomimage/showone.html.twig");
    }
}
