<?php

/* person/showone.html.twig */
class __TwigTemplate_22d98a324a1eceeafe637a8cab16a2f77b3eff3cf13a84b49fccda27f5958ca1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 4
        $this->parent = $this->loadTemplate("base.html.twig", "person/showone.html.twig", 4);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'middle' => array($this, 'block_middle'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "person/showone.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "person/showone.html.twig"));

        // line 3
        $context["m"] = $this->loadTemplate("macros.twig", "person/showone.html.twig", 3);
        // line 4
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 7
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
<link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("/css/person/showone.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 11
    public function block_middle($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "middle"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "middle"));

        // line 12
        echo "<div id=\"person\" >
    ";
        // line 13
        if (($context["message"] ?? $this->getContext($context, "message"))) {
            // line 14
            echo "    <h1> ";
            echo twig_escape_filter($this->env, ($context["message"] ?? $this->getContext($context, "message")), "html", null, true);
            echo "</h1>
    ";
        }
        // line 16
        echo "    
    ";
        // line 17
        if ((isset($context["person"]) || array_key_exists("person", $context))) {
            // line 18
            echo "    ";
            if (($context["person"] ?? $this->getContext($context, "person"))) {
                // line 19
                echo "    <div  class=\"heading\">
        <div class=\"title\" >";
                // line 20
                echo twig_escape_filter($this->env, $this->getAttribute(($context["person"] ?? $this->getContext($context, "person")), "fullname", array()), "html", null, true);
                echo " </div>
           ";
                // line 21
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
                    echo " 
        <div class=\"editbutton button1\" >
            <a class=\"editbutton\" href = \"/";
                    // line 23
                    echo twig_escape_filter($this->env, ($context["lang"] ?? $this->getContext($context, "lang")), "html", null, true);
                    echo "/person/addbookmark/";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["person"] ?? $this->getContext($context, "person")), "personid", array()), "html", null, true);
                    echo "\" >";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("bookmark.person"), "html", null, true);
                    echo "</a>
       </div>
        ";
                }
                // line 26
                echo "        ";
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
                    echo " 
        <div class=\"editbutton \">
            <a class=\"editbutton\" href = \"/admin/person/";
                    // line 28
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["person"] ?? $this->getContext($context, "person")), "personid", array()), "html", null, true);
                    echo "\" >";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("edit.person"), "html", null, true);
                    echo "</a>
        </div>
        ";
                }
                // line 31
                echo "    
    </div>
    ";
            }
            // line 34
            echo "    
    ";
            // line 35
            if (($context["images"] ?? $this->getContext($context, "images"))) {
                // line 36
                echo "    <div class=\"imagegroup\" >
        ";
                // line 37
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["images"] ?? $this->getContext($context, "images")));
                foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                    // line 38
                    echo "        <div class=\"image\">
            <div class=\"imageimage\" ><a href=\"";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute($context["image"], "link", array()), "html", null, true);
                    echo "\"><img src=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["image"], "fullpath", array()), "html", null, true);
                    echo "\" /></a></div>
            <div class=\"imagelabel\"> ";
                    // line 40
                    echo twig_escape_filter($this->env, $this->getAttribute($context["image"], "title", array()), "html", null, true);
                    echo " </div>
        </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 43
                echo "    </div>
    ";
            }
            // line 45
            echo "    
  
        ";
            // line 47
            if (($context["refs"] ?? $this->getContext($context, "refs"))) {
                // line 48
                echo "          <div class=\"refgroup\" >
        <div class=\"reflabel\">";
                // line 49
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("liens"), "html", null, true);
                echo " : </div>
        <div class=\"reflist\">
        ";
                // line 51
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["refs"] ?? $this->getContext($context, "refs")));
                foreach ($context['_seq'] as $context["_key"] => $context["ref"]) {
                    // line 52
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
                // line 54
                echo "        </div>
            </div>
        ";
            }
            // line 57
            echo "
    
     
    
    ";
            // line 61
            if (($context["text"] ?? $this->getContext($context, "text"))) {
                // line 62
                echo "    <div class=\"text\" >
        ";
                // line 63
                echo ($context["text"] ?? $this->getContext($context, "text"));
                echo "
    </div>
    ";
            }
            // line 66
            echo "    
    ";
            // line 67
            if (($context["eventtree"] ?? $this->getContext($context, "eventtree"))) {
                // line 68
                echo "    <div class=\"eventtree\" >
        ";
                // line 69
                echo $context["m"]->gettree($this->getAttribute(($context["eventtree"] ?? $this->getContext($context, "eventtree")), "topNode", array()), ($context["incidents"] ?? $this->getContext($context, "incidents")));
                echo " 
    </div>
    ";
            }
            // line 72
            echo "    ";
        }
        // line 73
        echo "</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "person/showone.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  240 => 73,  237 => 72,  231 => 69,  228 => 68,  226 => 67,  223 => 66,  217 => 63,  214 => 62,  212 => 61,  206 => 57,  201 => 54,  190 => 52,  186 => 51,  181 => 49,  178 => 48,  176 => 47,  172 => 45,  168 => 43,  159 => 40,  153 => 39,  150 => 38,  146 => 37,  143 => 36,  141 => 35,  138 => 34,  133 => 31,  125 => 28,  119 => 26,  109 => 23,  104 => 21,  100 => 20,  97 => 19,  94 => 18,  92 => 17,  89 => 16,  83 => 14,  81 => 13,  78 => 12,  69 => 11,  57 => 8,  53 => 7,  44 => 6,  34 => 4,  32 => 3,  11 => 4,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# templates/person/showone.html.twig #}

{% import 'macros.twig' as m %}
{% extends 'base.html.twig' %}

{% block stylesheets %}
{{ parent() }}
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
", "person/showone.html.twig", "/home/paul/symfony3/syfflsas3/app/Resources/views/person/showone.html.twig");
    }
}
