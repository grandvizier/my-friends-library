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
        // line 10
        echo "    </head>
    <body>
        <div id=\"header\">
        \t<img src=\"\" alt=\"the friending library\" />
        \t<div id=\"main_nav\">
        \t\t<span>";
        // line 15
        $this->displayBlock('main_nav', $context, $blocks);
        echo "</span>
        \t\t<div id=\"login\">
        \t\t";
        // line 17
        if ($this->getAttribute($this->getContext($context, "app"), "user")) {
            // line 18
            echo "        \t\t\t<span><a href=\"/profile\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "username"), "html", null, true);
            echo "</a></span>
        \t\t\t<span><a href=\"/logout\">Logout</a></span>
    \t\t\t";
        } else {
            // line 21
            echo "    \t\t\t\t<span><a href=\"/login\">Login</a></span>
        \t\t";
        }
        // line 23
        echo "        \t\t</div>
        \t</div>
        </div>
        <div id=\"content\">
            ";
        // line 27
        $this->displayBlock('body', $context, $blocks);
        // line 28
        echo "        </div>
        <div id=\"footer\">
            ";
        // line 30
        $this->displayBlock('footer', $context, $blocks);
        // line 31
        echo "        </div>
        ";
        // line 32
        $this->displayBlock('javascripts', $context, $blocks);
        // line 33
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
        // line 8
        echo "        \t<link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/css/main.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
        ";
    }

    // line 15
    public function block_main_nav($context, array $blocks = array())
    {
    }

    // line 27
    public function block_body($context, array $blocks = array())
    {
    }

    // line 30
    public function block_footer($context, array $blocks = array())
    {
    }

    // line 32
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
        return array (  120 => 32,  115 => 30,  110 => 27,  105 => 15,  98 => 8,  95 => 7,  89 => 6,  83 => 33,  81 => 32,  78 => 31,  76 => 30,  72 => 28,  70 => 27,  64 => 23,  60 => 21,  53 => 18,  51 => 17,  46 => 15,  39 => 10,  37 => 7,  33 => 6,  29 => 5,  23 => 1,);
    }
}
