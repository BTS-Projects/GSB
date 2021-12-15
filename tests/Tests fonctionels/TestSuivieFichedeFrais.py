from tests_connexion_comptable import*

#ouverture de la page suivre les paiements de fiche de frais
driver.find_element(By.NAME,"SficheFrais").click()

driver.find_element(By.NAME,"lstVisiteurs").click()
driver.find_element(By.ID, "a131").click()