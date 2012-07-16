<?php

/* ::base.html.twig */
class __TwigTemplate_f4dcf8fe0c9e5a535920e426b58f9a87 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'main_nav' => array($this, 'block_main_nav'),
            'body' => array($this, 'block_body'),
            'footer' => array($this, 'block_footer'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 7
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 8
        echo "    </head>
    <body>
        <div id=\"header\">
        \t<img src=\"\" alt=\"the friending library\" />
        \t<div id=\"main_nav\">
        \t\t<span>";
        // line 13
        $this->displayBlock('main_nav', $context, $blocks);
        echo "</span>
        \t\t";
        // line 14
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($_app_, "user")) {
            // line 15
            echo "        \t\t\t<span><a href=\"/profile\">";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "user"), "username"), "html", null, true);
            echo "</a></span>
        \t\t\t<span><a href=\"/logout\">Logout</a></span>
    \t\t\t";
        } else {
            // line 18
            echo "    \t\t\t\t<span><a href=\"/login\">Login</a></span>
        \t\t";
        }
        // line 20
        echo "        \t</div>
        </div>
        <div id=\"content\">
            ";
        // line 23
        $this->displayBlock('body', $context, $blocks);
        // line 24
        echo "        </div>
        <div id=\"footer\">
            ";
        // line 26
        $this->displayBlock('footer', $context, $blocks);
        // line 27
        echo "        </div>
        ";
        // line 28
        $this->displayBlock('javascripts', $context, $blocks);
        // line 29
        echo "    </body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo "The Friending Library";
    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 13
    public function block_main_nav($context, array $blocks = array())
    {
    }

    // line 23
    public function block_body($context, array $blocks = array())
    {
    }

    // line 26
    public function block_footer($context, array $blocks = array())
    {
    }

    // line 28
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 28,  110 => 26,  105 => 23,  76 => 26,  72 => 24,  70 => 23,  65 => 20,  40 => 10,  21 => 3,  42 => 8,  94 => 26,  91 => 25,  53 => 15,  18 => 1,  326 => 100,  320 => 96,  317 => 95,  313 => 94,  310 => 93,  305 => 90,  299 => 86,  296 => 85,  292 => 84,  289 => 83,  284 => 80,  270 => 79,  266 => 77,  251 => 75,  241 => 73,  232 => 70,  219 => 66,  209 => 62,  185 => 58,  167 => 57,  158 => 52,  127 => 47,  113 => 41,  104 => 34,  101 => 33,  75 => 22,  74 => 20,  52 => 11,  49 => 13,  163 => 52,  139 => 45,  124 => 46,  118 => 41,  109 => 36,  99 => 33,  84 => 27,  81 => 28,  73 => 20,  69 => 18,  62 => 14,  41 => 7,  92 => 28,  86 => 6,  46 => 13,  29 => 5,  19 => 1,  27 => 3,  33 => 6,  102 => 34,  78 => 27,  61 => 18,  56 => 12,  44 => 12,  38 => 6,  25 => 4,  37 => 7,  34 => 6,  30 => 4,  123 => 24,  108 => 35,  95 => 7,  90 => 28,  87 => 27,  83 => 29,  26 => 3,  22 => 6,  20 => 1,  55 => 9,  48 => 7,  45 => 14,  36 => 6,  248 => 96,  238 => 72,  234 => 88,  227 => 69,  223 => 83,  218 => 80,  216 => 79,  213 => 63,  210 => 77,  207 => 76,  198 => 71,  192 => 60,  177 => 61,  174 => 60,  171 => 59,  164 => 56,  160 => 54,  155 => 51,  153 => 49,  149 => 50,  146 => 47,  143 => 46,  137 => 45,  126 => 43,  116 => 42,  112 => 37,  107 => 31,  85 => 28,  82 => 25,  77 => 39,  67 => 17,  63 => 14,  32 => 6,  24 => 11,  23 => 1,  17 => 1,  201 => 72,  195 => 61,  187 => 62,  181 => 63,  178 => 57,  172 => 56,  168 => 54,  165 => 53,  156 => 48,  151 => 45,  148 => 44,  145 => 43,  142 => 42,  134 => 44,  131 => 49,  128 => 35,  122 => 32,  119 => 31,  111 => 21,  106 => 29,  103 => 19,  100 => 13,  97 => 26,  93 => 24,  89 => 6,  79 => 40,  68 => 20,  64 => 13,  60 => 22,  57 => 18,  54 => 12,  50 => 14,  47 => 9,  43 => 7,  39 => 8,  35 => 5,  31 => 3,  28 => 1,);
    }
}
