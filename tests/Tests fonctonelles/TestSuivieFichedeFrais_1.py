from tests_connexion_comptable import*

#ouverture de la page suivre les paiements de fiche de frais
try:
    driver.find_element(By.NAME,"SficheFrais").click()
    log('connexion à la page reussie')
except Exception as ex:
    log('echec de la connexion à la page')
    print(ex)

try:
    driver.find_element(By.NAME,"lstVisiteurs").click()
    driver.find_element(By.ID, "f4").click()
    log('choix du visiteur reussie')
except Exception as ex:
    log("echec du choix du visiteur")
    pritn(ex)

#tests de l'état mise en paiement
try:
    driver.find_element(By.NAME,"lstEtats").click()
    driver.find_element(By.ID,"MP").click()
    driver.find_element(By.ID,"ok").click()
    log("verification des fiches mise en paiement reussie")
except Exception as ex:
    log('echec de la verification de la vue des diches mise en paiements")
    print(ex)