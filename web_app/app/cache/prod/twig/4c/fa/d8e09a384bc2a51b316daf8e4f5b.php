<?php

/* FOSUserBundle:Group:show_content.html.twig */
class __TwigTemplate_4cfad8e09a384bc2a51b316daf8e4f5b extends Twig_Template
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
        echo "<div class=\"fos_user_group_show\">
    <p>";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("group.show.name", array(), "FOSUserBundle"), "html", null, true);
        echo ": ";
        if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_group_, "getName", array(), "method"), "html", null, true);
        echo "</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:show_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 3,  42 => 8,  94 => 26,  91 => 25,  53 => 8,  18 => 1,  326 => 100,  320 => 96,  317 => 95,  313 => 94,  310 => 93,  305 => 90,  299 => 86,  296 => 85,  292 => 84,  289 => 83,  284 => 80,  270 => 79,  266 => 77,  251 => 75,  241 => 73,  232 => 70,  219 => 66,  209 => 62,  185 => 58,  167 => 57,  158 => 52,  127 => 47,  113 => 41,  104 => 34,  101 => 33,  75 => 22,  74 => 19,  52 => 14,  49 => 13,  163 => 52,  139 => 45,  124 => 46,  118 => 41,  109 => 36,  99 => 33,  84 => 27,  81 => 24,  73 => 20,  69 => 19,  62 => 19,  41 => 7,  92 => 28,  86 => 6,  46 => 14,  29 => 4,  19 => 1,  27 => 3,  33 => 5,  102 => 34,  78 => 23,  61 => 13,  56 => 12,  44 => 12,  38 => 6,  25 => 2,  37 => 8,  34 => 6,  30 => 4,  123 => 24,  108 => 35,  95 => 18,  90 => 28,  87 => 27,  83 => 14,  26 => 3,  22 => 6,  20 => 2,  55 => 9,  48 => 7,  45 => 14,  36 => 6,  248 => 96,  238 => 72,  234 => 88,  227 => 69,  223 => 83,  218 => 80,  216 => 79,  213 => 63,  210 => 77,  207 => 76,  198 => 71,  192 => 60,  177 => 61,  174 => 60,  171 => 59,  164 => 56,  160 => 54,  155 => 51,  153 => 49,  149 => 50,  146 => 47,  143 => 46,  137 => 45,  126 => 43,  116 => 42,  112 => 37,  107 => 31,  85 => 28,  82 => 25,  77 => 39,  67 => 17,  63 => 14,  32 => 4,  24 => 11,  23 => 3,  17 => 1,  201 => 72,  195 => 61,  187 => 62,  181 => 63,  178 => 57,  172 => 56,  168 => 54,  165 => 53,  156 => 48,  151 => 45,  148 => 44,  145 => 43,  142 => 42,  134 => 44,  131 => 49,  128 => 35,  122 => 32,  119 => 31,  111 => 21,  106 => 29,  103 => 19,  100 => 27,  97 => 26,  93 => 24,  89 => 16,  79 => 40,  68 => 20,  64 => 13,  60 => 22,  57 => 18,  54 => 12,  50 => 11,  47 => 9,  43 => 7,  39 => 6,  35 => 5,  31 => 4,  28 => 1,);
    }
}
