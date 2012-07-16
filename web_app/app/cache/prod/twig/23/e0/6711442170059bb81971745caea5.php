<?php

/* TwigBundle:Exception:exception.css.twig */
class __TwigTemplate_23e06711442170059bb81971745caea5 extends Twig_Template
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
        // line 1
        echo "/*
";
        // line 2
        if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
        $this->env->loadTemplate("TwigBundle:Exception:exception.txt.twig")->display(array_merge($context, array("exception" => $_exception_)));
        // line 3
        echo "*/
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 39,  86 => 6,  46 => 14,  29 => 6,  19 => 1,  27 => 3,  33 => 7,  102 => 19,  78 => 15,  61 => 13,  56 => 12,  44 => 7,  38 => 7,  25 => 3,  37 => 8,  34 => 6,  30 => 4,  123 => 24,  108 => 20,  95 => 18,  90 => 17,  87 => 16,  83 => 14,  26 => 4,  22 => 4,  20 => 2,  55 => 9,  48 => 7,  45 => 7,  36 => 5,  248 => 96,  238 => 90,  234 => 88,  227 => 84,  223 => 83,  218 => 80,  216 => 79,  213 => 78,  210 => 77,  207 => 76,  198 => 71,  192 => 67,  177 => 61,  174 => 60,  171 => 59,  164 => 55,  160 => 54,  155 => 51,  153 => 50,  149 => 48,  146 => 47,  143 => 46,  137 => 45,  126 => 43,  116 => 22,  112 => 20,  107 => 31,  85 => 28,  82 => 27,  77 => 39,  67 => 9,  63 => 14,  32 => 5,  24 => 4,  23 => 3,  17 => 1,  201 => 72,  195 => 66,  187 => 62,  181 => 63,  178 => 57,  172 => 56,  168 => 54,  165 => 53,  156 => 48,  151 => 45,  148 => 44,  145 => 43,  142 => 42,  134 => 37,  131 => 44,  128 => 35,  122 => 32,  119 => 31,  111 => 21,  106 => 29,  103 => 19,  100 => 27,  97 => 26,  93 => 24,  89 => 16,  79 => 40,  68 => 15,  64 => 13,  60 => 22,  57 => 22,  54 => 10,  50 => 6,  47 => 8,  43 => 7,  39 => 8,  35 => 4,  31 => 9,  28 => 4,);
    }
}
