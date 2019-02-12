<?php

/* macros.twig */
class __TwigTemplate_65a766cf05da047b0f4620d0aae97ab9da8aafdef470d33aa4209d995360dbc8 extends Twig_Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "macros.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "macros.twig"));

        // line 1
        echo "

";
        // line 23
        echo "

";
        // line 41
        echo "

";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function gettree($__child__ = null, $__incidents__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "child" => $__child__,
            "incidents" => $__incidents__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "tree"));

            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "tree"));

            // line 4
            echo "    ";
            $context["m"] = $this;
            // line 5
            echo "    <a href = \"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["child"] ?? $this->getContext($context, "child")), "getLink", array(), "method"), "html", null, true);
            echo " \" > ";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["child"] ?? $this->getContext($context, "child")), "label", array(0 => "FR"), "method"), "html", null, true);
            echo "</a>
    ";
            // line 6
            if (($context["incidents"] ?? $this->getContext($context, "incidents"))) {
                // line 7
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["incidents"] ?? $this->getContext($context, "incidents")));
                foreach ($context['_seq'] as $context["_key"] => $context["incident"]) {
                    // line 8
                    echo "    ";
                    if (($this->getAttribute($context["incident"], "eventid", array()) == $this->getAttribute(($context["child"] ?? $this->getContext($context, "child")), "eventid", array()))) {
                        // line 9
                        echo "    <div class='incident' >    <a href = \"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["incident"], "link", array(), "array"), "html", null, true);
                        echo " \" > ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["incident"], "label", array(), "array"), "html", null, true);
                        echo "</a></div>
    ";
                    }
                    // line 11
                    echo "    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['incident'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 12
                echo "    ";
            }
            // line 13
            echo "        ";
            if ($this->getAttribute(($context["child"] ?? $this->getContext($context, "child")), "children", array())) {
                // line 14
                echo "        <ul>
            ";
                // line 15
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["child"] ?? $this->getContext($context, "child")), "children", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 16
                    echo "                <li>
                ";
                    // line 17
                    echo $context["m"]->gettree($context["i"], ($context["incidents"] ?? $this->getContext($context, "incidents")));
                    echo " 
                </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                echo "        </ul>
    ";
            }
            
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

            
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 25
    public function getlinks($__label__ = null, $__list__ = null, $__class__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "list" => $__list__,
            "class" => $__class__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "links"));

            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "links"));

            // line 26
            if (($context["list"] ?? $this->getContext($context, "list"))) {
                // line 27
                echo "   ";
                if ((twig_length_filter($this->env, ($context["list"] ?? $this->getContext($context, "list"))) < 6)) {
                    // line 28
                    echo "  <div class=\"linklist\">
     ";
                } else {
                    // line 30
                    echo "  <div class=\"longlinklist\">
     ";
                }
                // line 32
                echo "     <div class='label'>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans(($context["label"] ?? $this->getContext($context, "label"))), "html", null, true);
                echo "</div>
     <div class=\"list\" >
     ";
                // line 34
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["list"] ?? $this->getContext($context, "list")));
                foreach ($context['_seq'] as $context["key"] => $context["link"]) {
                    // line 35
                    echo "        <div class='link' ><a href='";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["link"], "link", array()), "html", null, true);
                    echo "' >";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["link"], "label", array()), "html", null, true);
                    echo "</a> </div>
     ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['link'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
                echo "     </div>
  </div>
";
            }
            
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

            
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "macros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 37,  189 => 35,  185 => 34,  179 => 32,  175 => 30,  171 => 28,  168 => 27,  166 => 26,  146 => 25,  123 => 20,  114 => 17,  111 => 16,  107 => 15,  104 => 14,  101 => 13,  98 => 12,  92 => 11,  84 => 9,  81 => 8,  76 => 7,  74 => 6,  67 => 5,  64 => 4,  45 => 3,  33 => 41,  29 => 23,  25 => 1,);
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

{% macro tree(child, incidents) %}
    {% import _self as m %}
    <a href = \"{{ child.getLink() }} \" > {{ child.label(\"FR\") }}</a>
    {% if incidents %}
    {% for incident in incidents %}
    {% if incident.eventid == child.eventid %}
    <div class='incident' >    <a href = \"{{ incident['link'] }} \" > {{incident['label'] }}</a></div>
    {% endif %}
    {% endfor %}
    {% endif %}
        {% if child.children %}
        <ul>
            {% for i in child.children %}
                <li>
                {{ m.tree(i, incidents) }} 
                </li>
            {% endfor %}
        </ul>
    {% endif %}
{% endmacro %}


{% macro links(label, list, class) %}
{% if list %}
   {% if (list | length ) < 6  %}
  <div class=\"linklist\">
     {% else %}
  <div class=\"longlinklist\">
     {% endif %}
     <div class='label'>{{ label | trans }}</div>
     <div class=\"list\" >
     {% for key, link in list  %}
        <div class='link' ><a href='{{link.link}}' >{{link.label}}</a> </div>
     {% endfor %}
     </div>
  </div>
{% endif %}
{% endmacro %}


", "macros.twig", "/home/paul/symfony3/syfflsas3/app/Resources/views/macros.twig");
    }
}
