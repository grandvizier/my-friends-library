<?php

/* TFLLibraryBookBundle:Book:create.html.twig */
class __TwigTemplate_64c25549416c407fb690607fead3df23 extends Twig_Template
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
        <title>New Book created</title>
    </head>
    <body>
        A new book will be created with the isbn: ";
        // line 6
        echo twig_escape_filter($this->env, $this->getContext($context, "isbn"), "html", null, true);
        echo "
        <br/>
        For user: <pre>";
        // line 8
        echo twig_escape_filter($this->env, $this->getContext($context, "user"), "html", null, true);
        echo "</pre> 
        <pre>";
        // line 9
        echo twig_escape_filter($this->env, $this->getContext($context, "google_books"), "html", null, true);
        echo "</pre>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "TFLLibraryBookBundle:Book:create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 9,  29 => 8,  24 => 6,  17 => 1,);
    }
}
