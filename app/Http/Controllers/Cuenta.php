<?php

namespace App\Http\Controllers;

use App\model\Cuenta_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class Cuenta extends Controller
{

    public function index()
    {
        return view('landing');
    }

    public function login()
    {
        return view('cuenta/login');
    }

    public function registrof()
    {
        return view('cuenta/registrof');
    }

    public function checkdomain($correo)
    {
        $arra = ["fungipeople.com", "henkel.com", "saludangeles.com", "grupoensamble.mx", "ceaconstructora.com", "covami.com", "ucienega.edu.mx", "nelsonmandela.edu.mx", "cuatroarquitectura.com", "gracecarbide.com", "kao.com", "ACUMULADORESYEPEZ.COM", "hotmal.com", "aedificacion.com", "tlv.mx", "damosamedica.com", "embutidoscorona.com.mx", "salsascastillo.com", "etj.mx", "segaconsultores.com.mx", "zunne.mx", "smartbamboo.mx", "grupocapitalom.com", "sirguadalajara.com", "general.com", "ldrsolutions.com.mx", "gymbo.edu.mx", "MARTI.COM.MX", "konsulta.mx", "domoscopernico.com", "matugeo.com", "afirme.com", "persianasexpress.com", "netscape.net", "gamail.com", "samomx.com", "accedo.tv", "bayer.com", "ALPEZZI.COM.MX", "geur.com.mx", "legna-sci.com", "albatrosss.com", "cidur.com.mx", "cas.com.mx", "indeko.mx", "pactivevergreen.com", "airexs.com.mx", "camsdemexico.com.mx", "bigdutchman.com.mx", "tototl.net", "gmail.com", "integral-energy.com", "hotamail.com", "highsociety.com.mx", "pollopepe.com.mx", "movimientodecontenedores.com", "cwfacilities.com.mx", "FLEX.COM", "pmi.com", "inegi.org.mx", "solucioneskenko.com", "itesm.mx", "globant.com", "tequiladesign.mx", "velastoscano.mx", "eomoda.com", "tsy.com.mx", "hotmaol.es", "gontor.com", "kitchennail.com", "outlok.com", "mtqmexico.com", "gmil.com", "ciudadninos.edu.mx", "controldigital.com.mx", "ureblock.com.mx", "hortifrut.com", "gltec.mx", "frioingenieria.com", "capicua.mx", "zetina.net", "pasteleriasmarisa.com.mx", "geodis.com.mx", "HOTMAIL.COM", "cytcompetenciaytalento.com.mx", "construlatam.mx", "SERIT360.MX", "SMATBAMBOO.MX", "natgas.com.mx", "parabolaestudio.com", "solistica.com", "vimaseguridad.com", "yza.mx", "starfilters.mx", "85outlook.com", "improving.com", "galojal.com.mx", "tractozone.com.mx", "montanoindustrial.com", "facilitando.mx", "virbac.com.mx", "h2architecture.com", "gmail.com.com", "BRADA.COM.MX", "classfurnishings.com", "FUNDACIONBEST.ORG.MX", "gmal.com.mx", "ciosa.com", "confianse.com", "eolaboratorio.com.mx", "itsoeh.edu.mx", "santanaventos.mx", "dmcmusiccenter.com", "innovafis.mx", "hotmaill.com", "tvazteca.com.mx", "consultingfinancial.com.mx", "megaterra.net", "gamasconstruccion.com", "flotta.com.mx", "marsigtravel.com", "gmeil.com", "sigtrade.mx", "vime.com.mx", "proyectura.com", "cerule.com", "arquitecturaemblematica.mx", "recolectoradiamante.com", "kadled.mx", "fudex.mx", "deloittemx.com", "paquetexpress.com.mx", "gloriairma.com", "uteg.edu.mx", "hotmil.com", "SOFMA.COM.MX", "fsanpablo.com", "masmovil.mx", "kanautli.com", "grupocopeso.com", "glomedicstar.com", "Gmail.com", "BEATRICHEHOME.MX", "OLEOFINOS.COM.MX", "perezgomez.mx", "alesso.com.mx", "vmsenergy.com", "TRANSFORMADORESRTE.COM", "mrcd.com.mx", "ava-mx.com", "madelina.com.mx", "zadro.com.mx", "mapfre.com.mx", "pinedi.mx", "hoelpuertadelsol.com.mx", "puntoparalelo.mx", "merza.com", "sispotagua.com", "mtconsulting.com", "myp.mx", "INTEGRAL-ENERGY.COM", "grupoawa.com.mx", "imperquimiademaco.com", "grupo-eco.com", "notaria29zapopan.com.mx", "deandaconsultores.com", "NHEOGESTIONES.MX", "hotnail.com", "lebasigroup.com", "arquitectura-aif.mx", "sonno.com.mx", "transformadoresrte.com", "tecnologiasscontrola.com.mx", "ccip.mx", "elevatetextiles.com", "cinemex.net", "santapasta.mx", "fastecmexico.com", "carniceriazapopan.com", "firmusliving.com", "camaradecomerciogdl.mx", "yahoo.com.br", "hospitaldepadua.com", "imdin.com", "maseratimexico.com", "rsmmx.mx", "eponderosa.com", "fortanemx.com", "sagbabogados.mx", "gruposci.com.mx", "gmailo.com", "suzukivallarta.com.mx", "cafiver.com.mx", "gcempaques.com", "aol.com", "aim.com", "arrendadoracamcar.com", "yujo.com.mx", "leyesynumeros.org", "colemx.com", "gpa.com.mx", "kiva.mx", "cassaplan.com.mx", "grupoar.mx", "tulteca.com", "fibrashop.mx", "zapopan.gob.mx", "grupooruga.com", "marlex.com.mx", "lumo.mx", "intugo.co", "ssarquitecturayconstruccion.com", "bunge.com", "imaurbanismo.com", "mcgconsultores.com", "2box.mx", "cecyteh.edu.mx", "diazigareda.com", "merik.com", "shelonabel.com", "EXPLORER.COM.MX", "corem.com.mx", "bellisima.com.mx", "highpro.com.mx", "newberry201.com", "ceti.mx", "necnontrade.com", "navidad-arbol.com", "ammed.com.mx", "premiumcar.mx", "grupoveq.com", "ois.com.mx", "gimeil.com", "petguru.mx", "lecascarie.com", "nnconsultingfirm.com", "inback.mx", "oemoda.com", "gmai.com", "arrozprogreso.com", "cencon.com.mx", "geldencosmeticos.mx", "gmial.com", "cpi19.com.mx", "uki.com.mx", "h-h.com.mx", "preveconsultorialegal.mx", "omnilife.com", "acrisc.com.mx", "macropay.mx", "sanchezdevanny.com", "puritronic.com.mx", "soonaoasis.mx", "dosb.com.mx", "brual.com.mx", "grupocasillas.mx", "ocr-gdl.net", "covervan.com", "ralseza.com", "icmansa.com", "sinci.com", "hotmail.com", "industriasrochin.com", "santanaeventos.mx", "agroindustriasrafer.com", "materealiza.com", "aguirrearquitectos.mx", "kaard.com.mx", "viasc.com", "biaanimexico.com", "trasenda.com.mx", "saljeconsultores.com", "ficium.mx", "grupojaza.com", "ritabarrazainteriorismo.com", "vinosamerica.com.mx", "cdm.la", "121corp.com", "vicar.com.mx", "mayasa.com.mx", "grupobimbo.com", "dulcetipico.com.mx", "grupocsi.mx", "taponesdemadera.com", "grupomgb.com.mx", "DIMECA.COM.MX", "coloremoda.com", "umexfood.com", "umg.edu.mex", "estrasol.com.mx", "hoymail.com", "pycaries.com", "chilepepe.com.mx", "loanco.com.mx", "gamil.com", "vidusa.com", "escumovil.com", "caffenio.com", "iemd.com.mx", "AOL.COM", "coreypro.com.mx", "autore.design", "cmn.edu.mx", "innowalloccidente.com", "oncemexico.mx", "gilmeil.com", "lasdelicias.com.mx", "engie.com", "impulsotransac.org", "gsf.mx", "viveskyfest.com", "romagestoria.com", "leew.org.mx", "skycleaners.com.mx", "HORKEST.COM", "lossenderos.com.mx", "partidamorales.com", "barraganasesores.com", "arclad.com", "bugy.mx", "dorothygaynor.com", "grupo-chirino.com", "corporativoseem.com", "sandvik.com", "magan.mx", "cleandfixed.com", "emcorpabogados.com", "log-on.mx", "icloud.com", "estudiols.com.mx", "TERRICA.MX", "gtravel.com.mx", "yahoo.es", "OUTLOOK.COM", "syharquitectos.com", "hitmail.com", "louvastudio.com", "estafeta.com", "renovable.com.mx", "gmaio.com", "decaber.com", "almer.com.mx", "LIVERPOOL.COM.MX", "corporativosade.com.mx", "juegamas.mx", "colmenares.org.mx", "sofma.com.mx", "menita.com.mx", "zaar.mx", "lees.org.mx", "dinami.mx", "lusio.com.mx", "gme.com", "rfcontadores.com", "suportika.com", "gmail.comn", "paqueteexpress.com.mx", "saljeconusltores.com", "clikalia.com", "meeseringenieria.com", "maderaslamision.com", "klientek.com", "aschoco.org.mx", "APSIGDL.COM", "idc-arquitectura.com", "gemail.com", "afbicentenario.com", "verdeproma.com", "ia360.mx", "golflozano.com.mx", "conclaveconstructora.com", "firstcash.com", "tacen.com.mx", "circleplast.com.mx", "amatepec.com.mx", "yahoo.com", "44gmail.com", "piagui.com", "haarq.mx", "grupideamx.com", "zame.com.mx", "gestoriag.com", "inmobiliariajdl.com.mc", "iprintla.com.mx", "LUBTRAC.COM.MX", "qvf.mx", "hotmail.como.mx", "proulex.udg.mx", "solucionesauditivasdeoccidente.com", "gmal.com", "HOTMAIL.ES", "geodis.com", "civicadigital.com", "grupotecni.com", "esloventanas.com", "geodec.com.mx", "believeandcreate.com.mx", "gmail.comcom", "punto58.com.mx", "isuzuguadalajara.com", "GMAIL.COM", "yahoo.com.mx", "liceodelvalle.edu.mx", "varlix.com.mx", "prodigy.net.mx", "pccare.com.mx", "Outlook.com", "osvargroup.com", "arke.mx", "namearquitectos.com", "qhcsteel.com", "kaporo.com", "caracol.com.mx", "CORPORATIVOEM3.COM.MX", "medinalegal.com.mx", "hersheys.com", "carne.com", "segufi.com", "hotmaul.com", "oficinco.com", "2000gmail.com", "sisega.mx", "arquitecturalegal.com.mx", "empmex.com", "villacampestre.com.mx", "mavi.mx", "jtexpress.com", "aisolutions.com.mx", "riorecolectoraehijos.com.mx", "projhem.com", "universidadcei.com", "estral.com.mx", "siogdl.com", "dhc.com.mx", "creditoycasasgdl.com", "todoentractopartes.com", "microtec.com.mx", "creditoycasasmx.com", "alpezzi.com.mx", "blackcoffeegallery.com.mx", "rsequipos.com", "cervantes.edu.mx", "arcacontal.com", "jaliscoedu.mx", "lambdamx.com", "oxxo.com", "upper.energy", "gposac.com", "cvcdeoccidente.com", "grupoandrea.com", "SANVITE.COM", "valoraconsultores.com", "gmsil.com", "lupesbbq.com", "ibushop.com.mx", "altracapital.com.mx", "en-red.mx", "banorte.com", "terrica.mx", "alcozap.com", "tokal.com.mx", "medicsolutionsmx.com", "dorantesaranda.com", "maraingenieros.com", "liverpool.com.mx", "peugeotgdl.com", "esolutionsmx.com", "jtexpress.mx", "facto.mx", "ginstalba.com", "hotmial.com", "pilunka.com", "richmuebles.mx", "collins.com.mx", "iclod.com", "cek.mx", "officedepot.com.mx", "waldos.com", "grupogv.mx", "tierravida.mx", "alkale.mx", "fmc-ag.com", "Live.com", "mideestudio.com", "HOTMAIL.COm", "werkshop.mx", "gomeztagleabogados.com.mx", "alucolor.com", "grupodiniz.com.mx", "empirewc.mx", "ucg.edu.mx", "rehabilit360.mx", "YAHOO.COM", "mac.com", "exinsa.com", "me.com", "counselors.com.mx", "innovasport.com", "famcas.com", "neumaq.com.mx", "velbej.com", "templadoshp.com.mx", "fasee.mx", "seacargo.com", "t-ingles.com", "gmail.com.mx", "corporativodiverso.com", "craftdistribucion.com", "rrs.com.mx", "inmobiliaria.com.mx", "camcorattan.com", "grupofiar.com", "consultoresma.mx", "macropay.com", "urbisora.com", "yahoo.mx", "creditaria.com", "iusgarante.com", "enredgdl.com.mx", "jalisco.gob.mx", "alquima.mx", "aspros.mx", "lumbromx.com", "hotmai.com", "grupoproamex.com", "saenz.cc", "b2bseguros.mx", "averna.com", "lamar.edu.mx", "gfa.com.mx", "aldaramiz.com", "hqp.mx", "estrategica.com.mx", "epsvial.com", "greyeventos.com", "gasolineraremus.com", "metropolis.mx", "garvi.com.mx", "masseguridad.com.mx", "mepiel.com.mx", "mueblesartex.com", "moderof.com", "juguetron.mx", "izzi.mx", "televisa.com.mx", "outloo.es", "proyectosallegra.com.mx", "CORPORATIVOSEEM.COM", "caminoreal.com.mx", "interceramic.com", "telmexmail.com", "acerosocotlan.mx", "came.org.mx", "dentalia.com", "proturgdl.com", "grupoagraz.com", "renovablesdelsur.com", "inventivepower.com.mx", "soporteindustrial.com", "alsain.mx", "OUTLOOK.ES", "live.com", "efamedios.com", "mx.gt.com", "inmobiliariajdl.com.mx", "tarimarte.com", "jibia.com.mx", "dish.com.mx", "live.com.mx", "veagn.com", "corporativomb.mx", "dhl.com", "bidg.mx", "vectralis.com", "EXTINMEXICO.MX", "beehivesystems.mx", "inarkenfuzion.com", "vfmichel.com", "merciapid.com", "gmx.com", "adcsoluciones.mx", "hoteldemetria.com", "oleofinos.com.mx", "pabloalexanderson.com", "adventa.mx", "omnisafe.com.mx", "alumnos.udg.mx", "cannon.com.mx", "impulsoracultural.com", "lasauceda.com", "atxk.com", "belmont-trading.com", "cafison.com", "beyondsugar.com.mx", "concremex.com", "yandex.com", "nirva.com.mx", "omtrek.mx", "banterra.com.mx", "cinepolis.com", "hotmail.con", "alinnova.com.mx", "muczamasociados.com", "grupocpq.com", "urbanissa.mx", "aguilarkaram.com", "grupomonar.com.mx", "trapsint.com", "cucinacapitale.com", "hotmail.ocom", "iteso.mx", "outlook.es", "outlook.ex", "estudiopii.com", "etiflexocc.com", "jabil.com", "grupolso.com", "medgar.com.mx", "colmex.mx", "mmedihealthjd.com", "aio.com.mx", "hotmsil.com", "biochemsoluciones.com", "rigobertogonzalez.mx", "twobits.co", "ifa.com.mx", "smingenieria.com.mx", "rtt.mx", "finvivir.com.mx", "proactible.com", "tec.mx", "zap.com", "petco.com.mx", "thecornerstone.mx", "hotmail.es", "mail.com", "dtcpvc.com", "biopappel.com", "dalton.com.mx", "usiglobal.com", "desoflex.com", "icoalum.net", "creatupasta.com.mx", "totofast.com", "sic.com.mx", "hm.com", "APPLIVISUAL.COM", "hotmil.conm", "hotmaiñ.com", "edu.uag.mx", "urvet.mx", "aecis-arkitektura.com", "zesatipasta.mx", "rozasoc.com", "guadalajara.gob.mx", "mareva.com.mx", "empaquesanjorge.com", "SWIMSTORE.MX", "s4t.com.mx", "movaps.com", "dondeexpress.com.mx", "marmolesnatura.com", "bairesgdl.com", "claudettecolor.com", "fusionyformas.com", "yahoo.com.mcx", "gvadeto.com", "oulook.com", "vitasanitas.com.mx", "bivarquitectura.com", "PVD.COM.MX", "xn--gamasconstruccin-kvb.com", "bommor.com.mx", "hotelpuertadelsol.com.mx", "abrepointing.com", "eninfinitum.con", "aldeta.mx", "slovensko.com.mx", "ymail.com", "tallermarteza.com", "prada.mx", "handelfoods.com", "cobaej.edu.mx", "vwpatria.mx", "boden.com.mx", "pku.com.mx", "foodfun.com.mx", "prognosis.mx", "bee-clean.mx", "gmail.con", "chevroletmilenio.com", "spaa.com.mx", "bartel.com.mx", "gruporeyesseguros.com.mx", "construire.mx", "hp.com", "prosalon.mx", "inx.mx", "lessco.mx", "cmoctezuma.com.mx", "aryco.mx", "tequila.tecmm.edu.mx", "dittabau.com", "grupostrategie.com", "sicammexico.com.mx", "pollope.com.mx", "excel.com.mx", "impermexa.com", "cadu.com.mx", "hotmail.com.mx", "torrebonn.com", "tya.com.mx", "up.edu.mx", "select.com.mx", "expresionarquitectonica.com", "llanteratapatia.com", "basham.com.mx", "cordibus.mx", "villayvilla.com", "infinitummail.com", "ph.com.mx", "marblock.com", "protonmail.com", "YAHOO.COM.MX", "eduardoyasociados.com", "lepearquitectos.com", "inmobiliariapsi.com", "2aarquitectos.com", "mikiosko.mx", "anexabpo.com", "logitev.com", "cej.org.mx", "transportesit.com.mx", "ansa.cc", "tekprovider.net", "jr-ecotecnologia.com", "asasa.com.mx", "nouvte.mx", "solido.com.mx", "altomarseafoods.com", "homail.com", "micorreo.com", "makeitarquitectos.com", "cnrindustries.com", "rdconstructora.mx", "sotoyreynoso.com", "sureimpulsoradeideas.com", "golegal.com.mx", "espaciorecubrimientos.com.mx", "bb.com.mx", "accesscollection.com.mx", "outlook.com", "bleiz.mx", "fiorentina.com.mx", "megared.net.mx", "inverti.com.mx", "solcommerce.com.mx", "cooperativaconsigo.coop", "bricksmx.com", "gesscorpzero.com", "impulsotres.com", "balken.com.mx", "tresdiez.com", "310med.com", "gpisa.com.mx", "chs.lat", "FAHORRO.COM.MX", "ARTEKPANEL.COM", "fragua.com.mx", "nutriosfera.com", "technotense.com", "mrcd.com.mnx", "congresojal.gob.mx", "pmi1210.com", "colegiounionmexico.com", "plenituddevida.org.mx", "kargio.com", "codi.com.mx", "grupoabsa.com", "insof.com.mx", "naver.com", "etto.mx", "gexik.com", "walmart.com", "stuen.com.mx", "castlerock.com.mx", "unionmavel.com", "beatrichehome.mx", "AREASVERDES.COM.MX", "inovapharma.com.mx", "barbaasociados.com", "corportivosade.com.mx", "avitual.com", "aresarquitectos.com", "totalplay.com.mx", "vidaesprimero.com", "tpitic.com.mx", "alumni.ipade.mx", "ca-capital.com", "qemul.com", "mopada.com", "quierotv.mx", "imail.com", "GRUPOCONDIMENTOS.COM", "gotmail.com", "alica-automotriz.com", "royalenfieldheritage.com", "psocorporativo.com", "HOTMAILC.OM", "entasisgrupoconstructor.com", "grupoigartua.mx", "arhome.com.mx", "academicos.udg.mx", "artsana.com", "gbpo.com.mx", "beermex.com.mx", "basan.mx", "celliniautos.com", "plumberone.com.mx", "suspirosdenuez.com.mx", "gmail.c0m.mx", "desarrollosccs.com", "ldcdesarrolladora.mx", "musacc.mx", "GNH.MX", "outloock.com", "indemexico.com", "sgcs.mx", "hilia.mx", "todolimpio.com", "grupodeo.com.mx", "aditivospq.com", "ultranatom.com", "plosamaquinaria.com", "jasmne.com", "giph.com.mx", "fibragdl.com", "ccalculo.com", "digitalife.com.mx", "otmail.com", "oximedica.com.mx", "tacun.com.mx", "solfeggio528.com", "becomaq.com", "tecnologiascontrola.com.mx", "recotecnia.com", "hyparch.com.mx", "live.it", "icloud.coom", "gmail.comm", "mastertech.mx", "agmedia.mx", "sotorisolve.com", "20d.com.mx", "elmaltes.mx", "metral.mx", "construval.com.mx", "gmai.com.mx", "bedbath.com", "crc.mx", "plasmex.mx", "smartsol.mx", "agilgob.com", "ual.edu.mx", "yrnet.com", "inmar-bienesraices.com", "thincrs.com", "ARTANDCRAFT.MX", "aslcorporativo.com", "biosferazul.com", "ferrero.com", "engloba.com.mx", "planigrupo.com", "eipsa.mx", "gnc.com.mx", "impuls.com.mx", "sye.com.mx", "yurizatarain.com", "grupodmx.com.mx", "gdlmedica.com", "agarcia.com.mx", "esmaq.com.mx", "cuestacampos.com", "gyobeautysalon.com", "grupoawa.com", "aquaelectric.com.mx", "hormail.com", "tecnofiltracion.com", "sanmina.com", "iprahs.com.mx", "nivel3.mx", "jbhunt.com", "excelflexo.com", "yahoo.co.uk", "lalomayelvergel.com", "fastecinternational.com", "alumnos.upla.cl", "odamx.com", "brab.mx", "estrenon.com", "cexplorer.com.mx", "ecisolutions.com", "flex.com", "hotmaol.com", "gruposam.com", "novonafar.com", "colegioae.edu.mx", "dental.com.mx", "igaac.com", "moldesmendoza.com.mx", "biofertilizantes.mx", "neurospond.com", "outloo.com", "redudg.udg.mx", "naturalscents.com.mx", "unedl.edu.mx", "SCOULAR.COM", "lopxarquitectura.com.mx", "TOTALPLAY.COM.MX", "syd.com.mx", "grupoparrilla.com", "universidad-une.com", "medeqmedical.com.mx", "dagmedical.com", "750.marketing", "ampproyectos.mx", "lamdamx.com", "pixelarte.mx", "primecomms.mx", "JTCHEMICAL.COM.MX", "190gmail.com", "skycleaners.com", "msn.com", "asfg.edu.mx", "garsa.mx", "afcasolutions.com", "imex.mx", "cosea.mx", "pfm.mx", "sanchezangulo.com", "fibrauno.mx", "aug.mx", "haciendalaescoba.com", "holaguadalajara.com.mx", "com", "edu", "mx", "me","gob","gob.mx"];

        $mail = substr($correo, strpos($correo, "@") + 1);

        if (in_array($mail, $arra)) {
            return true;
        } else {
            return false;
        }
    }

    public function registrarf(Request $request)
    {
        $this->list_email($request->correo, 'Registro de usuario fisica');

        if ($this->checkdomain($request->correo)) {
            $request->validate([
                'correo'       => 'required|email|unique:usuarios',
                'contrasena'   => 'required|min:8',
                'ccontrasena'  => 'same:contrasena|min:8',
                //'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
            ]);

            Cuenta_model::registrarf($request->correo, Crypt::encryptString($request->contrasena));
        } else {
            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'Correo no valido'
            ]);
            Redirect::to(url('cuenta/registrof'))->send();
        }
    }

    public function registrom()
    {
        return view('cuenta/registrom');
    }

    public function registrarm(Request $request)
    {
        $this->list_email($request->correo, 'Registro de usuario moral');

        $request->validate([
            'correo'      => 'required|email|unique:usuarios',
            'contrasena'  => 'required|min:8',
            'ccontrasena' => 'same:contrasena|min:8',
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);
        Cuenta_model::registrarm($request->correo, Crypt::encryptString($request->contrasena));
    }

    public function activar($correo, $token)
    {
        Cuenta_model::activar($correo, $token);
    }

    public function recupera()
    {
        return view('cuenta/recupera');
    }

    public function recuperar(Request $request)
    {
        $this->list_email($request->correo, 'Recuperar contraseña');

        $request->validate([
            'correo'      => 'required|email',
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);

        Cuenta_model::recuperar($request->correo);
    }

    public function cambiac($correo, $token)
    {
        $vars = [
            'correo' => $correo,
            'token' => $token
        ];

        if (Cuenta_model::cambiac($correo, $token)) {

            return view('cuenta/cambiac', $vars);
        }
    }

    public function cambiarc(Request $request)
    {
        $request->validate([
            'contrasena'  => 'required|min:8',
            'ccontrasena' => 'same:contrasena|min:8',
        ]);

        $contrasena = Crypt::encryptString($request->contrasena);

        Cuenta_model::cambiarc($request->correo, $contrasena, $request->token);
    }

    public function auth(Request $request)
    {
        $this->list_email($request->correo, 'Inicio de sesión');
        $request->validate([
            'correo'     => 'required|email',
            'contrasena' => 'required|min:8',
            //'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);

        Cuenta_model::auth($request->correo, Crypt::encryptString($request->contrasena));
    }

    public function cambiar_contrasena(Request $request)
    {

        $request->validate([
            'cactual'       => 'required|min:8',
            'ncontrasena'   => 'required|min:8',
            'ccontrasena'   => 'same:ncontrasena|min:8',
        ]);

        if (Cuenta_model::cambiar_contrasena($request->all())) {

            session()->flash('alert', [
                'type' => 'success',
                'msg'  => 'La contraseña se cambió con éxito'
            ]);
        } else {

            session()->flash('alert', [
                'type' => 'danger',
                'msg'  => 'La contraseña actual no es correcta, verifique e intente nuevamente'
            ]);
        }

        redirect::away(url()->previous())->send();
    }

    public function logout()
    {
        session()->flush();
        return redirect()->action('cuenta@index');
    }

    public function preguntas_respuestas()
    {
        return view('cuenta/preguntas_respuestas');
    }

    public function list_email($correo, $accion)
    {
        Cuenta_model::count_email($correo, $accion);

        return true;
    }
}
