<?php

/* person/pdfone.html.twig */
class __TwigTemplate_b95b141945eb89f2e38fa722647ca61a2c276c7dcd8ce123b7254cb48746a57a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'middle' => array($this, 'block_middle'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "person/pdfone.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "person/pdfone.html.twig"));

        // line 2
        echo "
";
        // line 3
        $context["m"] = $this->loadTemplate("macros.twig", "person/pdfone.html.twig", 3);
        // line 4
        echo "
";
        // line 5
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 9
        echo "
";
        // line 10
        $this->displayBlock('middle', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        echo "
<link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("/css/person/showone.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 10
    public function block_middle($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "middle"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "middle"));

        // line 11
        echo "<div id=\"person\" >
    ";
        // line 12
        if (($context["message"] ?? $this->getContext($context, "message"))) {
            // line 13
            echo "    <h1> ";
            echo twig_escape_filter($this->env, ($context["message"] ?? $this->getContext($context, "message")), "html", null, true);
            echo "</h1>
    ";
        }
        // line 15
        echo "    
    ";
        // line 16
        if ((isset($context["person"]) || array_key_exists("person", $context))) {
            // line 17
            echo "    ";
            if (($context["person"] ?? $this->getContext($context, "person"))) {
                // line 18
                echo "    <div  class=\"heading\">
        <div class=\"title\" >";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute(($context["person"] ?? $this->getContext($context, "person")), "fullname", array()), "html", null, true);
                echo " </div>
           ";
                // line 20
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
                    echo " 
        <div class=\"editbutton button1\" >
            <a class=\"editbutton\" href = \"/";
                    // line 22
                    echo twig_escape_filter($this->env, ($context["lang"] ?? $this->getContext($context, "lang")), "html", null, true);
                    echo "/person/addbookmark/";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["person"] ?? $this->getContext($context, "person")), "personid", array()), "html", null, true);
                    echo "\" >";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("bookmark.person"), "html", null, true);
                    echo "</a>
       </div>
        ";
                }
                // line 25
                echo "        ";
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
                    echo " 
        <div class=\"editbutton \">
            <a class=\"editbutton\" href = \"/admin/person/";
                    // line 27
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["person"] ?? $this->getContext($context, "person")), "personid", array()), "html", null, true);
                    echo "\" >";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("edit.person"), "html", null, true);
                    echo "</a>
        </div>
        ";
                }
                // line 30
                echo "    
    </div>
    ";
            }
            // line 33
            echo "    
    ";
            // line 34
            if (($context["images"] ?? $this->getContext($context, "images"))) {
                // line 35
                echo "    <div class=\"imagegroup\" >
        ";
                // line 36
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["images"] ?? $this->getContext($context, "images")));
                foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                    // line 37
                    echo "        <div class=\"image\">
            <div class=\"imageimage\" ><a href=\"";
                    // line 38
                    echo twig_escape_filter($this->env, $this->getAttribute($context["image"], "link", array()), "html", null, true);
                    echo "\"><img src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["image"], "fullpath", array()), "html", null, true);
                    echo "\" /></a></div>
            <div class=\"imagelabel\"> ";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute($context["image"], "title", array()), "html", null, true);
                    echo " </div>
        </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 42
                echo "    </div>
    ";
            }
            // line 44
            echo "    
  
        ";
            // line 46
            if (($context["refs"] ?? $this->getContext($context, "refs"))) {
                // line 47
                echo "          <div class=\"refgroup\" >
        <div class=\"reflabel\">";
                // line 48
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("liens"), "html", null, true);
                echo " : </div>
        <div class=\"reflist\">
        ";
                // line 50
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["refs"] ?? $this->getContext($context, "refs")));
                foreach ($context['_seq'] as $context["_key"] => $context["ref"]) {
                    // line 51
                    echo "        <div class=\"ref\" ><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["ref"], "path", array()), "html", null, true);
                    echo "\"> ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["ref"], "label", array()), "html", null, true);
                    echo "</a></div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ref'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "        </div>
            </div>
        ";
            }
            // line 56
            echo "
    
     
    
    ";
            // line 60
            if (($context["text"] ?? $this->getContext($context, "text"))) {
                // line 61
                echo "    <div class=\"text\" >
        ";
                // line 62
                echo ($context["text"] ?? $this->getContext($context, "text"));
                echo "
    </div>
    ";
            }
            // line 65
            echo "    
    ";
            // line 66
            if (($context["eventtree"] ?? $this->getContext($context, "eventtree"))) {
                // line 67
                echo "    <div class=\"eventtree\" >
        ";
                // line 68
                echo $context["m"]->gettree($this->getAttribute(($context["eventtree"] ?? $this->getContext($context, "eventtree")), "topNode", array()), ($context["incidents"] ?? $this->getContext($context, "incidents")));
                echo " 
    </div>
    ";
            }
            // line 71
            echo "    ";
        }
        // line 72
        echo "</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "person/pdfone.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  245 => 72,  242 => 71,  236 => 68,  233 => 67,  231 => 66,  228 => 65,  222 => 62,  219 => 61,  217 => 60,  211 => 56,  206 => 53,  195 => 51,  191 => 50,  186 => 48,  183 => 47,  181 => 46,  177 => 44,  173 => 42,  164 => 39,  158 => 38,  155 => 37,  151 => 36,  148 => 35,  146 => 34,  143 => 33,  138 => 30,  130 => 27,  124 => 25,  114 => 22,  109 => 20,  105 => 19,  102 => 18,  99 => 17,  97 => 16,  94 => 15,  88 => 13,  86 => 12,  83 => 11,  74 => 10,  62 => 7,  59 => 6,  50 => 5,  40 => 10,  37 => 9,  35 => 5,  32 => 4,  30 => 3,  27 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# templates/person/pdfone.html.twig #}

{% import 'macros.twig' as m %}

{% block stylesheets %}

<link href=\"{{ asset('/css/person/showone.css') }}\" rel=\"stylesheet\" />
{% endblock %}

{% block middle %}
<div id=\"person\" >
    {% if message %}
    <h1> {{message}}</h1>
    {% endif %}
    
    {% if person is defined %}
    {% if person %}
    <div  class=\"heading\">
        <div class=\"title\" >{{ person.fullname}} </div>
           {% if is_granted('ROLE_USER') %} 
        <div class=\"editbutton button1\" >
            <a class=\"editbutton\" href = \"/{{lang}}/person/addbookmark/{{person.personid}}\" >{{'bookmark.person' | trans}}</a>
       </div>
        {% endif %}
        {% if is_granted('ROLE_ADMIN') %} 
        <div class=\"editbutton \">
            <a class=\"editbutton\" href = \"/admin/person/{{person.personid}}\" >{{'edit.person' | trans }}</a>
        </div>
        {% endif %}
    
    </div>
    {% endif %}
    
    {% if images %}
    <div class=\"imagegroup\" >
        {% for image in images %}
        <div class=\"image\">
            <div class=\"imageimage\" ><a href=\"{{image.link}}\"><img src=\"{{image.fullpath}}\" /></a></div>
            <div class=\"imagelabel\"> {{image.title}} </div>
        </div>
        {% endfor %}
    </div>
    {% endif %}
    
  
        {% if refs %}
          <div class=\"refgroup\" >
        <div class=\"reflabel\">{{'liens' | trans }} : </div>
        <div class=\"reflist\">
        {% for ref in refs %}
        <div class=\"ref\" ><a href=\"{{ref.path}}\"> {{ref.label}}</a></div>
        {% endfor %}
        </div>
            </div>
        {% endif %}

    
     
    
    {% if text  %}
    <div class=\"text\" >
        {{ text | raw }}
    </div>
    {% endif %}
    
    {% if eventtree %}
    <div class=\"eventtree\" >
        {{ m.tree(eventtree.topNode, incidents) }} 
    </div>
    {% endif %}
    {% endif %}
</div>
{% endblock %}
", "person/pdfone.html.twig", "/home/paul/symfony3/syfflsas3/app/Resources/views/person/pdfone.html.twig");
    }
}
