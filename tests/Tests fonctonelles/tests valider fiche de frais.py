from tests_connexion_comptable import*

#ouverture de la page permetant de valider les fiches de frais
driver.find_element(By.NAME,"VficheFrais").click()

#tests du changement de visiteur et de mois
driver.find_element(By.NAME,"visiteur").click()
driver.find_element(By.ID,"f4").click()