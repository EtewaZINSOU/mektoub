    /*
    * EXO 1 :
    */
// soit le document HTML suivant :

<html>
<body>

<ol>
    <li>
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </li>
</ol>

<script type="text/javascript">

// remplissez l de telle sorte qu'il soit alimenté par les nœuds enfant du tag ul
// complétez les instructions de façon à supprimer les nœuds enfant du tag ul

var l = ...;
for(var i=0 ... ; i < ...; i++) ... .removeChild(l[i]);

</script>
</body>
</html>



    /*
    * EXO 2 :
    */

// Soit l'objet t suivant :

<script type="text/javascript">
var t = {
    p1 : 'ok',
    m1 : function(){
        alert(this.p1);
    }
}

// Ecrire une méthode permettant d'exécuter une fonction js, au bout d'une durée n,
// comme par exemple la méthode t.m1 (sans closure)
</script>



    /*
    * EXO 3 :
    */

<script type="text/javascript">

var t = {
    p1 : 'ok',
    p2 : true,
    m1 : function(){
        alert(this.p1);
    }
}

// Ecrire une méthode permettant de tester périodiquement une condition (sous la forme d'une instruction js)
// et de déclencher lorsque celle ci est remplie, une fonction js, avant expiration d'un délai, si ce dernier est renseigné.
//
// par exemple, après l'instruction suivante :
setTimeout("t.p2 = false;",5000);
//
// en ne dépassant pas une limite de 8s, vérifier toutes les 2 secondes si t.p2 vaut false afin d'exécuter si tel est le cas, la méthode t.m1

</script>



    /*
    * EXO 4 :
    */

<script type="text/javascript">
// Soit l'objet suivant :
var o = { };
// comment procèderiez vous pour mettre en place un mécanisme de variable 'protected' uniquement accessible via deux méthodes
// getter et setter de cet objet ?

</script>