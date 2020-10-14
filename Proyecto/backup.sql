DROP TABLE comentarios;

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentario` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO comentarios VALUES("14","Invitado","Arroz tres delicias","Muy buena pinta!","2020-07-09 12:11:02");
INSERT INTO comentarios VALUES("15","Invitado","Macarrones gratinados con atun","Tienen buena pinta!","2020-07-09 12:38:24");
INSERT INTO comentarios VALUES("17","Jose","Bolitas de bacalao","Facil de hacer y muy ricos!","2020-07-09 13:05:32");
INSERT INTO comentarios VALUES("20","Jose","Risotto de calabaza","Muy rico y saludable","2020-07-09 13:14:03");
INSERT INTO comentarios VALUES("27","Jose","Macarrones gratinados con atun","Muy buena receta","2020-07-11 13:44:18");
INSERT INTO comentarios VALUES("29","Jose","Macarrones a la bolo�esa","Faciles de hacer y muy ricos","2020-07-11 13:45:32");
INSERT INTO comentarios VALUES("30","Jose","Arroz tres delicias","F�cil de hacer y muy ricos!","2020-07-13 12:23:38");
INSERT INTO comentarios VALUES("31","Jose","Risotto de calabaza","Lo probar�!","2020-07-13 12:24:46");



DROP TABLE log;

CREATE TABLE `log` (
  `id` double NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=995 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO log VALUES("889","2020-07-07 20:05:12","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("890","2020-07-07 20:05:15","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("891","2020-07-07 20:05:17","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("892","2020-07-07 20:05:19","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("893","2020-07-07 20:05:21","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("894","2020-07-07 20:05:26","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("895","2020-07-07 20:06:15","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("896","2020-07-07 20:16:42","Invitado","Error inicio sesion");
INSERT INTO log VALUES("897","2020-07-07 20:16:57","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("898","2020-07-07 20:17:49","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("899","2020-07-07 20:17:58","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("900","2020-07-08 19:19:08","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("901","2020-07-08 19:19:28","josemi10@correo.ugr.es","Receta modificada");
INSERT INTO log VALUES("902","2020-07-08 19:19:43","josemi10@correo.ugr.es","Receta modificada");
INSERT INTO log VALUES("903","2020-07-08 19:19:56","josemi10@correo.ugr.es","Receta modificada");
INSERT INTO log VALUES("904","2020-07-08 19:27:27","josemi10@correo.ugr.es","Receta creada");
INSERT INTO log VALUES("905","2020-07-09 11:35:23","Invitado","Comentario creado");
INSERT INTO log VALUES("906","2020-07-09 11:37:30","Invitado","Comentario creado");
INSERT INTO log VALUES("907","2020-07-09 11:37:30","Invitado","Valoraci�n creada");
INSERT INTO log VALUES("908","2020-07-09 12:06:02","Invitado","Comentario creado");
INSERT INTO log VALUES("909","2020-07-09 12:06:02","Invitado","Valoraci�n creada");
INSERT INTO log VALUES("910","2020-07-09 12:10:50","Invitado","Comentario creado");
INSERT INTO log VALUES("911","2020-07-09 12:10:50","Invitado","Valoraci�n creada");
INSERT INTO log VALUES("912","2020-07-09 12:11:02","Invitado","Comentario creado");
INSERT INTO log VALUES("913","2020-07-09 12:11:02","Invitado","Valoraci�n creada");
INSERT INTO log VALUES("914","2020-07-09 12:38:24","Invitado","Comentario creado");
INSERT INTO log VALUES("915","2020-07-09 12:38:24","Invitado","Valoraci�n creada");
INSERT INTO log VALUES("916","2020-07-09 12:56:45","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("917","2020-07-09 12:57:05","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("918","2020-07-09 12:57:05","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("919","2020-07-09 12:57:16","josemi10@correo.ugr.es","Comentario eliminado");
INSERT INTO log VALUES("920","2020-07-09 12:57:49","josemi10@correo.ugr.es","Receta eliminada");
INSERT INTO log VALUES("921","2020-07-09 13:01:22","josemi10@correo.ugr.es","Receta creada");
INSERT INTO log VALUES("922","2020-07-09 13:05:32","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("923","2020-07-09 13:05:32","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("924","2020-07-09 13:12:42","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("925","2020-07-09 13:12:42","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("926","2020-07-09 13:13:11","josemi10@correo.ugr.es","Comentario eliminado");
INSERT INTO log VALUES("927","2020-07-09 13:13:41","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("928","2020-07-09 13:13:41","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("929","2020-07-09 13:14:03","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("930","2020-07-09 13:14:03","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("931","2020-07-09 13:36:58","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("932","2020-07-09 17:56:57","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("933","2020-07-09 17:57:24","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("934","2020-07-09 18:10:07","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("935","2020-07-09 18:10:11","e.josemi10@go.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("936","2020-07-09 18:10:18","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("937","2020-07-09 18:15:08","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("938","2020-07-09 18:18:07","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("939","2020-07-09 18:18:53","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("940","2020-07-09 18:19:42","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("941","2020-07-09 18:19:56","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("942","2020-07-09 18:22:21","josemi10@correo.ugr.es","Comentario eliminado");
INSERT INTO log VALUES("943","2020-07-10 17:18:39","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("944","2020-07-10 17:28:08","e.josemi10@go.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("945","2020-07-10 17:33:11","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("946","2020-07-10 17:33:18","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("947","2020-07-10 17:33:18","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("948","2020-07-10 17:33:29","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("949","2020-07-10 17:33:29","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("950","2020-07-10 17:35:23","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("951","2020-07-10 17:35:23","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("952","2020-07-10 17:35:46","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("953","2020-07-10 17:36:24","josemi10@correo.ugr.es","Comentario eliminado");
INSERT INTO log VALUES("954","2020-07-10 17:36:30","josemi10@correo.ugr.es","Comentario eliminado");
INSERT INTO log VALUES("955","2020-07-10 17:36:39","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("956","2020-07-10 18:15:25","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("957","2020-07-10 18:15:40","e.josemi10@go.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("958","2020-07-10 18:15:48","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("959","2020-07-10 18:18:30","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("960","2020-07-10 18:18:39","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("961","2020-07-10 18:19:24","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("962","2020-07-10 18:19:30","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("963","2020-07-10 18:31:32","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("964","2020-07-10 19:32:31","e.josemi10@go.ugr.es","Usuario modificado");
INSERT INTO log VALUES("965","2020-07-10 19:52:20","e.josemi10@go.ugr.es","Receta modificada");
INSERT INTO log VALUES("966","2020-07-10 19:53:11","e.josemi10@go.ugr.es","Receta modificada");
INSERT INTO log VALUES("967","2020-07-10 19:56:24","e.josemi10@go.ugr.es","Receta modificada");
INSERT INTO log VALUES("968","2020-07-10 20:02:11","e.josemi10@go.ugr.es","Usuario modificado");
INSERT INTO log VALUES("969","2020-07-10 20:02:28","e.josemi10@go.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("970","2020-07-10 20:02:35","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("971","2020-07-10 20:02:56","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("972","2020-07-10 20:03:11","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("973","2020-07-10 20:03:19","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("974","2020-07-11 13:40:05","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("975","2020-07-11 13:41:09","josemi10@correo.ugr.es","Usuario modificado");
INSERT INTO log VALUES("976","2020-07-11 13:41:11","josemi10@correo.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("977","2020-07-11 13:41:22","e.josemi10@go.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("978","2020-07-11 13:41:58","e.josemi10@go.ugr.es","Sesion cerrada");
INSERT INTO log VALUES("979","2020-07-11 13:42:21","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("980","2020-07-11 13:42:38","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("981","2020-07-11 13:42:38","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("982","2020-07-11 13:44:18","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("983","2020-07-11 13:44:18","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("984","2020-07-11 13:44:39","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("985","2020-07-11 13:45:32","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("986","2020-07-11 13:45:33","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("987","2020-07-13 12:22:39","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("988","2020-07-13 12:23:38","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("989","2020-07-13 12:23:38","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("990","2020-07-13 12:24:46","josemi10@correo.ugr.es","Comentario creado");
INSERT INTO log VALUES("991","2020-07-13 12:24:46","josemi10@correo.ugr.es","Valoraci�n creada");
INSERT INTO log VALUES("992","2020-07-13 12:32:04","Invitado","Error inicio sesion");
INSERT INTO log VALUES("993","2020-07-13 12:32:14","josemi10@correo.ugr.es","Sesion iniciada");
INSERT INTO log VALUES("994","2020-07-13 12:32:36","josemi10@correo.ugr.es","Sesion iniciada");



DROP TABLE recetas;

CREATE TABLE `recetas` (
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `ingredientes` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `preparacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `imagen` mediumblob,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO recetas VALUES("Macarrones a la bolo�esa","Jose Miguel","Pasta, Carne","La bolo�esa es una salsa que lleva carne de res molida, e incluso es m�s popular que el pesto. Se trata de una salsa espesa, originaria de la ciudad de Bolonia, que se prepara con carne picada de res, de cerdo o de buey, zanahoria, cebolla, apio, tomate, etc�tera, aunque existen much�simas variaciones con diversos ingredientes y especias. Para esta receta de macarrones a la bolo�esa vamos a intentar seguir la receta original para pasar el examen de la mamma italiana.","400 g de macarrones 500 g de carne picada de ternera 500 g de tomate natural triturado 100 gr de queso rallado especial para gratinar aceite de oliva virgen extra 1 zanahoria 150 g de apio 30 g de mantequilla 1/2 cebolla 1 vasito de vino de guiso Sal Pimienta Nuez moscada Albahaca","Para hacer los macarrones a la bolo�esa lo primero que debes hacer es pelar la cebolla y picarla en dados peque�os. Pela la zanahoria y p�cala en dados de igual tama�o. Lava el apio, qu�tale las hebras de las ramas y p�calo en cubitos. Coloca la mantequilla en una olla junto con el aceite de oliva y lleva al fuego. Cuando coja temperatura agrega las verduras y pocha a fuego suave. Cuando las verduras est�n blandas y la cebolla transparente, sube un poco la temperatura e incorpora la carne y el tomate natural triturado. Revuelve con una cuchara de madera e incorpora la leche, la nuez moscada reci�n molida, la sal y la pimienta negra molida al gusto. Reduce la temperatura, tapa y deja cocer a fuego lento durante 60 minutos. Cuando la salsa bolo�esa est� lista, llena una olla con agua y col�cala en el fuego. Cuando rompa hervor echa los macarrones y un pu�ado de sal y cocina seg�n las indicaciones del fabricante. Escurre la pasta al dente y sirve la macarrones a la bolo�esa con queso parmesano rallado por encima y algunas hojas de albahaca.","����\0JFIF\0\0\0\0\0\0��ICC_PROFILE\0\0\0lcms\0\0mntrRGB XYZ �\0\0\0\0)\09acspAPPL\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0�-lcms\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\ndesc\0\0\0�\0\0\0^cprt\0\0\\\0\0\0wtpt\0\0h\0\0\0bkpt\0\0|\0\0\0rXYZ\0\0�\0\0\0gXYZ\0\0�\0\0\0bXYZ\0\0�\0\0\0rTRC\0\0�\0\0\0@gTRC\0\0�\0\0\0@bTRC\0\0�\0\0\0@desc\0\0\0\0\0\0\0c2\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0text\0\0\0\0FB\0\0XYZ \0\0\0\0\0\0��\0\0\0\0\0�-XYZ \0\0\0\0\0\0\0\03\0\0�XYZ \0\0\0\0\0\0o�\0\08�\0\0�XYZ \0\0\0\0\0\0b�\0\0��\0\0�XYZ \0\0\0\0\0\0$�\0\0�\0\0��curv\0\0\0\0\0\0\0\0\0\0��c�k�?Q4!�)�2;�FQw]�kpz���|�i�}���0����\0C\0\n		\n
f��\0�Gڥ�����A�G~���R��j\"9�����(0���,�R#�^�8�B1,�j�@pZ�}!PqYέ�\\�I�V�\\��N&���H�TԸW�k��\'���j��]����z�� ��z�z�)��v
�vȥXA�Z��~,>�gN�@�s5}3��yE�-ެ˯�+�2���*�����߭X���!�_sX�����D��*�E���X�0�\\��4�irxg��fq�����:��)n��Z=Y[\n�Fd��J�\n�\'�%��@QQ���m���\\��l���Rf�
INSERT INTO recetas VALUES("Macarrones gratinados con atun","Jose Miguel","Pasta, Pescado","Fueron llegar a Espa�a y acompa�arlos con chorizo. No contentos con eso, poco despu�s les pusimos pescado, queso y los metimos al horno. �Hoy tocan macarrones gratinados con at�n!","400 g de macarrones 200 g de Tomate Frito Gallina Blanca 1 pastilla de Avecrem Caldo de Pollo 130 g de at�n en conserva 100 g de cebolla 2 dientes de ajo 100 g de mozzarella rallada 5 g de or�gano 40 ml de aceite de oliva virgen extra","Pon al fuego una olla con abundante agua y ll�vala a ebullici�n. Desmenuza una pastilla de Avecrem Pollo y vierte los macarrones. Cuece seg�n el tiempo indicado en el paquete y escurre la pasta. Reserva. Precalienta el horno a 180�C en modo gratinar. En una sart�n con aceite de oliva sofr�e el ajo y la cebolla finamente picados durante unos 10 minutos y a�ade el Tomate Frito Gallina Blanca, el at�n en conserva y el or�gano. Remueve y deja que el sofrito se cocine durante 5 minutos m�s.  Mezcla ahora el sofrito con los macarrones en una bandeja apta para horno y remueve para distribuir bien la salsa. Espolvorea la mozzarella y gratina en el horno durante unos 10 minutos. Emplata en caliente.","����\0JFIF\0\0`\0`\0\0��\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v90), quality = 90\n��\0C\0\n\n\n
���[�ϭ+�����b\"����	���5_���\ni����PD<>[��I�N��[\'�R/��Pa��+f���g?\\\n5bЅ
INSERT INTO recetas VALUES("Arroz tres delicias","Jose Miguel","Arroz","Aprende c�mo hacer arroz tres delicias chino, el famoso plato oriental que combina a la perfecci�n mariscos, pollo y vegetales. A��dele un sabor agridulce o salado seg�n tus gustos y an�mate a preparar un arroz diferente al de cada d�a."," � kilogramo de arroz largo 100 gramos de gambas peladas 100 gramos de jam�n York 1 unidad de pechuga de pollo 2 unidades de Huevo 50 gramos de guisantes 6 unidades de champi��n 1 unidad de cebolla 4 cucharadas soperas de Aceite 1 pizca de Sal y Pimienta ","Para empezar a preparara este delicioso arroz oriental, lo primero que haremos ser� alistar los ingredientes. Para ello, corta finamente la cebolla, lamina los champi�ones, corta el pollo en trocitos de un bocado y el jam�n york tambi�n c�rtalo en cuadros. Tambi�n tendr�s que hacer una tortilla francesa con los dos huevos y trocearla. A continuaci�n, caliente el aceite en una sart�n y sofr�e la cebolla con los champi�ones y el pollo. Saltea hasta que los ingredientes empiecen a tomar color. Cuando el pollo se haya dorado ligeramente a�ade a la preparaci�n del arroz tres delicias el jam�n york y remueve todo muy bien. Ahora le toca el turno al resto de ingredientes. A�ade los trozos de tortilla francesa y las gambas al sofrito. Sazona con un poco de sal y pimienta y reserva.  Aparte, dale un hervor a los guisantes y cocina el arroz blanco de forma tradicional. Cuando este listo, pasa por agua fr�a y escurre el arroz.   Ahora lleva los ingredientes del arroz chino a un bol y mezcla todo hasta que se integren por completo. Si deseas, como ingrediente opcional, puedes a�adir un poco de salsa soja o salsa agridulce y mezclar con el arroz.  Sirve y disfruta del arroz tres delicias chino para comer o en la hora de la cena. Te recomiendo acompa�arlo con una ensalada china agridulce. Y recuerda que si te ha gustado esta receta puedes encontrar muchas m�s en mi blog La Cocina de Juani.","����\0JFIF\0\0\0\0\0\0��\0C\0		\n
���.���<��Yn�e�=2�IF������`�\n��`�1�\"�~�1��(����h����PFiCi��F��<GҊY��儴QWpt>��\'T\\�|�ac����\0�l�)	�PjC��F\'B=��a�Cmy_vLюp����^���h�]ֱV���E��%p<�� �8*�\nT���G\0-��2�z�k��BfX�2���\\��4��P������J���$���5g֦4YA��ԾQX���2�âr��1�d�ȥ��,*�\0���h��m��`\\V�.x��;&�i0��y|�ܫ�4��{E�e�ۨلo���t��?r9R������QQ��;��E�@���U��x�D|�o�1�C��E0�<״�f(�,\n���k\\J�C��VѦᗁ����Ub,����r��쯼&kX5�̯D���)�}��
INSERT INTO recetas VALUES("Bolitas de bacalao","jose","Pescado","Las bolitas de bacalao son un entrante perfecto ya que son un aperitivo f�cil y r�pido de hacer. Sigue atento las instrucciones que te mostramos en RecetasGratis y descubre c�mo hacer bolas de bacalao y patata riqu�simas y, si quieres una receta m�s completa, puedes echar un vistazo a otra versi�n similar con la de croquetas de bacalao y perejil, que est�n tambi�n riqu�simas."," 350 gramos de bacalao 2 patatas 1 cebolla 1 diente de ajo 2 cucharadas soperas de harina de ma�z o maicena 2 huevos 2 cucharadas soperas de aceite 30 gramos de mantequilla 1 manojo de perejil 1 pizca de sal Aceite ","  Desalar el bacalao poni�ndolo a remojo en agua fr�a 24 horas antes, cambiar el agua varias veces, lavando bien el bacalao cada vez. Cocer durante 10 minutos y dejar escurrir. En otro cazo aparte ponemos a hervir agua con sal y laurel; cuando est�n en ebullici�n se echan las patatas previamente lavadas enteras o cortadas en trozos. Limpiar el bacalao de piel y espinas y desmigarlo, y pelar las patatas que trituraremos con un pasapur�s o aplastaremos con un tenedor. Aparte, pelar y picar fina la cebolla, ponerla en una sart�n con aceite a rehogar, y a�adir el ajo prensado y las migas de bacalao.   A�ade por �ltimo la mantequilla y la harina. Pasados 10 minutos retirar la masa de las bolas de patata y bacalao del fuego y deja enfriar. Formar bolitas de bacalao, a modo de bu�uelos, con la ayuda de dos cucharillas y fr�elas en abundante aceite caliente.","����\0JFIF\0\0`\0`\0\0��\0C\0		\n
\'ȶ�L�ZK��S��hΈ9\"t�^5����j�Щp�=AW��U��b����)�>�����	*�/D�=�&�\'�dU
INSERT INTO recetas VALUES("Sopa de pescado","Jose","Sopa, Pescado","La sopa de pescado es una receta sencilla que no puede faltar en la mesa durante las fiestas navide�as. Es el entrante perfecto para una cena donde los mariscos y los sabores del mar tomen protagonismo junto a una exquisita copa de vino.","500 gramos de espinas de pescado y c�scaras de las gambas     3 dientes de ajos     1 trozo de puerro     1 pu�ado de sal     150 gramos de almejas     300 gramos de mejillones     12 gambas     1 trozo de merluza sin espinas     1 cebolla     2 dientes de ajos     4 cucharadas soperas de tomate triturado     1 cucharada postre de piment�n dulce     1 chorro de aceite de oliva     1 pizca de sal","En una olla, vierte un chorro de aceite y a�ade las espinas de pescado. Pela las gambas y a�ade las cabezas y las c�scaras a la cazuela. Pela y pica la cebolla y los ajos. Agr�galos a otra cazuela con un chorro de aceite. D�jalos pochar.  Cuando la cebolla est� transparente, a�ade el piment�n y el tomate. Deja cocinar unos minutos. Vierte un cazo del fumet de pescado a este sofrito. A�ade todo a una procesadora de alimentos y tritura. Vierte el caldo de pescado en una cazuela. Incorpora las almejas y los mejillones previamente limpios. Corta el pescado en trozos y las gambas tambi�n. Puedes dejarlas enteras o en trozos.  A�ade el pescado y las gambas al caldo, d�jalo por 3-4 minutos m�s y apaga. Con el calor terminar� de cocinarse.","����\0JFIF\0\0`\0`\0\0��\0C\0		\n
INSERT INTO recetas VALUES("Risotto de calabaza","Jose","Arroz","El risotto es una t�cnica culinaria italiana que tiene su origen en el noroeste del pa�s, concretamente en el Piamonte, donde tradicionalmente hab�a abundancia de arroz. Cuando se cocina el risotto, el arroz cuece poco a poco con el resto de ingredientes del plato, no por separado. Ver�s como en este risotto de calabaza y champi�ones uno de los distintivos es el queso parmesano, fundamental en cualquier variedad de risotto."," 1 kilogramo de calabaza 1 Cebolleta 120 gramos de champi��n 60 gramos de Parmesano 1 chorro de Aceite de oliva 150 gramos de arroz blanco 1 pizca de Sal 1 pizca de Pimienta negra 700 mililitros de caldo de verduras ","Reunimos todos los ingredientes para elaborar el risotto de calabaza y champi�ones. Si no tienes caldo de verduras, puedes preparar uno mientras elaborados el resto de la receta. Para ello, pon a hervir unas verduras en abundante agua. Puedes incluir cebolla, puerro, apio y zanahoria. Deja hervir durante media hora y pon un poco de sal. Mientras se hace el caldo de verduras, hamos un sofrito con la cebolleta picada y un poco de aceite de oliva. Dejamos que se cocine durante 4 minutos. Agregamos la calabaza pelada y cortada en cuadraditos. Cuanto m�s peque�a la cortes antes se cocinar�. Es el momento de incorporar los champi�ones fileteados y limpios a este risotto de calabaza. Dejamos cocinar durante 2-3 minutos. Echamos el arroz, rehogamos mezclando bien con el resto de ingredientes y cubrimos con el caldo de verduras. Vamos moviendo el risotto de calabaza y champi�ones poco a poco y dejamos que reduzca el agua. El tiempo de cocci�n es de unos 20-22 minutos, dependiendo del tipo de arroz.  Es fundamental que el risotto quede cremoso, que no le falte caldo. Cuando tengamos el arroz casi listo, ponemos un poco de parmesano rallado y movemos para que se integre su sabor. Servimos el risotto de calabaza y champi�ones con un poco m�s de parmesano rallado por encima.","����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n%# , #&\')*)-0-(0%()(��\0C\n\n\n\n(((((((((((((((((((((((((((((((((((((((((((((((((((��\0�X\"\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0�암��w��ݜ�ݒm�;��m;&ӳ�N�^lH>�y^�n��Nכ_��ă�Ǌ�K�-i>�<�H���3m��\\=pڢ�c���#zper�}UǶp�����ƥK6X�����~
�%rAy����<ߊ���C3Y�A�1V;�P�:�����bT�^��n��U�2�7<�\\9cG\0
������_1�9����e�^������������-��w)���y�L�g�z�\"��5{g�$\"\0����<Ň��J�����\0



DROP TABLE usuarios;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` double DEFAULT NULL,
  `tipo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` mediumblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO usuarios VALUES("24","josemi","pelegrina","josemi@gmail.com","5fc84a49369f355afb5ec6aed2d47c19","mecina","34123456789","Colaborador","false","����\0JFIF\0\0\0\0\0\0��\0C\0		\n
���.���<��Yn�e�=2�IF������`�\n��`�1�\"�~�1��(����h����PFiCi��F��<GҊY��儴QWpt>��\'T\\�|�ac����\0�l�)	�PjC��F\'B=��a�Cmy_vLюp����^���h�]ֱV���E��%p<�� �8*�\nT���G\0-��2�z�k��BfX�2���\\��4��P������J���$���5g֦4YA��ԾQX���2�âr��1�d�ȥ��,*�\0���h��m��`\\V�.x��;&�i0��y|�ܫ�4��{E�e�ۨلo���t��?r9R������QQ��;��E�@���U��x�D|�o�1�C��E0�<״�f(�,\n���k\\J�C��VѦᗁ����Ub,����r��쯼&kX5�̯D���)�}��
INSERT INTO usuarios VALUES("25","Jose","Pelegrina Pelegrina","josemi10@correo.ugr.es","5fc84a49369f355afb5ec6aed2d47c19","Mecina Bombaron","34660836885","Administrador","false","����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n
INSERT INTO usuarios VALUES("27","Jose Miguel","Pelegrina Pelegrina","e.josemi10@go.ugr.es","5fc84a49369f355afb5ec6aed2d47c19","Mecina Bombar�n","34123456789","Colaborador","false","����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n
INSERT INTO usuarios VALUES("28","Javier","Martinez Baena","j_miguel98@hotmail.com","5fc84a49369f355afb5ec6aed2d47c19","Mecina Bombar�n","34123456789","Colaborador","false","�PNG



DROP TABLE valoraciones;

CREATE TABLE `valoraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receta` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `valoracion` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO valoraciones VALUES("19","Macarrones gratinados con atun","Jose","5");
INSERT INTO valoraciones VALUES("20","Macarrones a la bolo�esa","Jose","5");
INSERT INTO valoraciones VALUES("21","Arroz tres delicias","Jose","5");
INSERT INTO valoraciones VALUES("22","Risotto de calabaza","Jose","3");


