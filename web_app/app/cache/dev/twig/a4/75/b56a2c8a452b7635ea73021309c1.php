<?php

/* TFLLibraryBookBundle:Book:index.html.twig */
class __TwigTemplate_a475b56a2c8a452b7635ea73021309c1 extends Twig_Template
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
        echo "<html>
    <head>
        <title>This is the page for ";
        // line 3
        echo twig_escape_filter($this->env, $this->getContext($context, "book_title"), "html", null, true);
        echo "</title>
    </head>
    <body>
        <h1>";
        // line 6
        echo twig_escape_filter($this->env, $this->getContext($context, "book_title"), "html", null, true);
        echo "</h1>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "TFLLibraryBookBundle:Book:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 6,  21 => 3,  17 => 1,);
    }
}
