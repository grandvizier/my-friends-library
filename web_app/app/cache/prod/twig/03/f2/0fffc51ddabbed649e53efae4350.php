<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_03f20fffc51ddabbed649e53efae4350 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("FOSUserBundle::layout.html.twig");

        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 4
        if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
        if ($_error_) {
            // line 5
            echo "    <div>";
            if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_error_, array(), "FOSUserBundle"), "html", null, true);
            echo "</div>
";
        }
        // line 7
        echo "
<form action=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_check"), "html", null, true);
        echo "\" method=\"post\">
    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 9
        if (isset($context["csrf_token"])) { $_csrf_token_ = $context["csrf_token"]; } else { $_csrf_token_ = null; }
        echo twig_escape_filter($this->env, $_csrf_token_, "html", null, true);
        echo "\" />

    <label for=\"username\">";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 12
        if (isset($context["last_username"])) { $_last_username_ = $context["last_username"]; } else { $_last_username_ = null; }
        echo twig_escape_filter($this->env, $_last_username_, "html", null, true);
        echo "\" />

    <label for=\"password\">";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
    <input type=\"password\" id=\"password\" name=\"_password\" />

    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\" />
    <label for=\"remember_me\">";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>

    <input type=\"submit\" id=\"_submit\" name=\"_submit\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" />
</form>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 3,  42 => 8,  94 => 26,  91 => 25,  53 => 8,  18 => 1,  326 => 100,  320 => 96,  317 => 95,  313 => 94,  310 => 93,  305 => 90,  299 => 86,  296 => 85,  292 => 84,  289 => 83,  284 => 80,  270 => 79,  266 => 77,  251 => 75,  241 => 73,  232 => 70,  219 => 66,  209 => 62,  185 => 58,  167 => 57,  158 => 52,  127 => 47,  113 => 41,  104 => 34,  101 => 33,  75 => 22,  74 => 20,  52 => 11,  49 => 13,  163 => 52,  139 => 45,  124 => 46,  118 => 41,  109 => 36,  99 => 33,  84 => 27,  81 => 24,  73 => 20,  69 => 18,  62 => 14,  41 => 7,  92 => 28,  86 => 6,  46 => 9,  29 => 4,  19 => 1,  27 => 3,  33 => 5,  102 => 34,  78 => 23,  61 => 13,  56 => 12,  44 => 12,  38 => 6,  25 => 2,  37 => 8,  34 => 6,  30 => 4,  123 => 24,  108 => 35,  95 => 18,  90 => 28,  87 => 27,  83 => 14,  26 => 3,  22 => 6,  20 => 2,  55 => 9,  48 => 7,  45 => 14,  36 => 6,  248 => 96,  238 => 72,  234 => 88,  227 => 69,  223 => 83,  218 => 80,  216 => 79,  213 => 63,  210 => 77,  207 => 76,  198 => 71,  192 => 60,  177 => 61,  174 => 60,  171 => 59,  164 => 56,  160 => 54,  155 => 51,  153 => 49,  149 => 50,  146 => 47,  143 => 46,  137 => 45,  126 => 43,  116 => 42,  112 => 37,  107 => 31,  85 => 28,  82 => 25,  77 => 39,  67 => 17,  63 => 14,  32 => 5,  24 => 11,  23 => 3,  17 => 1,  201 => 72,  195 => 61,  187 => 62,  181 => 63,  178 => 57,  172 => 56,  168 => 54,  165 => 53,  156 => 48,  151 => 45,  148 => 44,  145 => 43,  142 => 42,  134 => 44,  131 => 49,  128 => 35,  122 => 32,  119 => 31,  111 => 21,  106 => 29,  103 => 19,  100 => 27,  97 => 26,  93 => 24,  89 => 16,  79 => 40,  68 => 20,  64 => 13,  60 => 22,  57 => 18,  54 => 12,  50 => 11,  47 => 9,  43 => 7,  39 => 7,  35 => 5,  31 => 4,  28 => 1,);
    }
}
