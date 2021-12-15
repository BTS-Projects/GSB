
from testdeconnexion import *
#lancement de la page
try:
    driver.find_element(By.NAME, 'RficheFrais').click()
    log(" - lance ment de la page renseigner la fiche de frais : OK-")
except Exception as ex:
    log("- Erreur, problème à l'ouverture de la page renseigner fiche frais...")
    print(ex)

# modification des valeur des éléments forfaitisés
try:

    setValeurInput('input[name="lesFrais[ETP]"]', 2000)
    setValeurInput('input[name="lesFrais[KM]"]', 2000)
    setValeurInput('input[name="lesFrais[NUI]"]', 2000)
    setValeurInput('input[name="lesFrais[REP]"]', 2000)
    driver.find_element(By.NAME, 'ElisteFrais').click()
    log("- ajout des valeurs des élements forfaitisées reussie...")
except Exception as ex:
    log("- Erreur, problème à l'ajout des élements forfaitisées...")
    print(ex)

#ajout d'un nouvelle élement hors forfait

try:
    setValeurInput('input[name="dateFrais"]',"10/11/2021")
    setValeurInput('input[name="libelle"]',"voiture !")
    setValeurInput('input[name="montant"]',150)
    driver.find_element(By.NAME,"btnAjouterFrais").click()
    driver.find_element(By.NAME,"btnSupprimerFrais").click()
    setValeurInput('input[name="dateFrais"]',"10/11/2021")
    setValeurInput('input[name="libelle"]',"voiture !")
    setValeurInput('input[name="montant"]',150)
    driver.find_element(By.NAME,"btnEffacerFrais").click()
    log("- creatin suppresion et effacement de frais fonctionnelle...")
except  Exception as ex:
    log("- Erreur, problème à la création de frais hors forfait...")
    print(ex)
