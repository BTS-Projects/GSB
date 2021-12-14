from testdeconnexion import *

# afficheage de la page afficher mes frais
try:
    driver.find_element(By.NAME,"AficheFrais").click()
    log("ouverture de la page  afficher mes fiches de frais ok...")
except Exception as ex:
    log("echec de l'ouverture de la page'")
    print(ex)
#selectionner une fiche de frais
try:
    driver.find_element(By.NAME,"lstMois").click()
    driver.find_element(By.ID, "202105").click()
    driver.find_element(By.ID,"ok").click()
    log("ouverture du mois selectionner reussie...")
except Exception as ex:
    log("ouverture du mois selectionner echouée...")
    print(ex)