 -- Allergènes
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Arachides');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Lait');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Œufs');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Blé');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Fruits à coque');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Soja');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Poisson');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Crustacés');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Moutarde');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Sésame');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Lupin');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Pommes de terre');
    INSERT INTO ALLERGENE (nomAllergene) VALUES ('Tomates');

    -- Pizzas
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Ren', 'En référence au nom de famille du fondateur de la Casa Del Pizza et à la fameuse pizza Reine (Regina).', 1, '19.99');
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Margherita', 'Pizza classique italienne avec sauce tomate, mozzarella et basilic.', 0, '10.99');
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Spéciale du Chef', 'Création unique du chef, mélange d''ingrédients sélectionnés.', 0, '14.99');
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Pepperoni', 'Pizza populaire avec pepperoni, fromage et sauce tomate.', 0, '12.50');
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Végétarienne', 'Garnie de légumes colorés, sans viande.', 0, '13.75');
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Quatre Fromages', 'Mélange savoureux de mozzarella, parmesan, gorgonzola et chèvre.', 0, '11.99');
    INSERT INTO PIZZA (nomPizza, descriptionPizza, estDuMoment, prixInitial) VALUES ('Hawaïenne', 'Jambon et ananas créent un équilibre sucré-salé délicieux.', 0, '15.50');

    -- Statut Livreur
    INSERT INTO STATUTLIVREUR (nomStatutLivreur) VALUES ('Disponible');
    INSERT INTO STATUTLIVREUR (nomStatutLivreur) VALUES ('Indisponible');


    -- Livreurs
    INSERT INTO LIVREUR (nomLivreur, prenomLivreur, mailLivreur, telLivreur, mdpLivreur, statutLivreur) VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', '1234567890', 'motdepasse123', 1);
    INSERT INTO LIVREUR (nomLivreur, prenomLivreur, mailLivreur, telLivreur, mdpLivreur, statutLivreur) VALUES ('Martin', 'Sophie', 'sophie.martin@example.com', '9876543210', 'secret456', 2);
    INSERT INTO LIVREUR (nomLivreur, prenomLivreur, mailLivreur, telLivreur, mdpLivreur, statutLivreur) VALUES ('Dubois', 'Pierre', 'pierre.dubois@example.com', '5556667777', 'mdpLivreur123', 1);

    -- Taille Pizza
    INSERT INTO TAILLEPIZZA (nomTaille, majorationTaille) VALUES ('Petite', 0.75);
    INSERT INTO TAILLEPIZZA (nomTaille, majorationTaille) VALUES ('Moyenne', 1);
    INSERT INTO TAILLEPIZZA (nomTaille, majorationTaille) VALUES ('Grande', 1.25);

    -- Catégories 
    INSERT INTO CATEGORIE (nomCategorie) VALUES ('Boisson');
    INSERT INTO CATEGORIE (nomCategorie) VALUES ('Dessert');

    -- Ingrédients
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Emmental râpé ', 'kg', 7.5, 1.2, 0.010, 10, 5);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Mozzarella', 'kg', 11, 1.2, 0.010, 1.2, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Cheddar', 'kg', 9.24, 1.2, 0.010, 5, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Comté', 'kg', 15.42, 1.2, 0.010, 5, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Bleu', 'kg', 15, 1.2, 0.010, 5, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Olives', 'kg', 12, NULL, NULL, 3, 1);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Ananas', 'kg', 4, 1.2, 0.010, 4, 1);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Jambon', 'kg', 7, 1.2, 0.010, 15, 5);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Pepperoni', 'kg', 1.2, 0.010, 9, 8, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Champignons', 'kg', 4, 1.2, 0.010, 15, 5);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Oignons', 'kg', 3, 1.2, 0.010, 10, 5);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Poivrons', 'kg', 4, 1.2, 0.010, 10, 5);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Sauce Tomate', 'l', 4, NULL, NULL , 15, 5);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Pâte à pizza', 'kg', 5, NULL, NULL, 20, 10);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Viande hâchée', 'kg', 18, 1.2, 0.010, 6, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Merguez', 'kg', 14, 1.2, 0.010, 6, 3);
    INSERT INTO INGREDIENT (nomIngredient, uniteDeMesure, prixInitial, prixSupplement, quantiteSupplement, quantiteStock, quantiteAlerte) VALUES ('Pomme de terre', 'kg', 2, 1.2, 0.010, 8, 3);

    -- IngredientsAllergenes
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (1,2);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (2,2);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (3,2);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (4,2);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (5,2);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (14,4);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (17,12);
    INSERT INTO INGREDIENTALLERGENE (numIngredient, numAllergene) VALUES (13,13);

    -- COMPOSITION
    INSERT INTO COMPOSITIONPIZZA VALUES (1, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (1, 12, 0.1);
    INSERT INTO COMPOSITIONPIZZA VALUES (1, 1, 0.02);
    INSERT INTO COMPOSITIONPIZZA VALUES (1, 8, 0.040);
    INSERT INTO COMPOSITIONPIZZA VALUES (1, 10, 0.040);
    INSERT INTO COMPOSITIONPIZZA VALUES (2, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (2, 2, 0.12);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 12, 0.1);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 1, 0.02);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 16, 0.03);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 15, 0.03);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 8, 0.03);
    INSERT INTO COMPOSITIONPIZZA VALUES (3, 9, 0.03);
    INSERT INTO COMPOSITIONPIZZA VALUES (4, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (4, 2, 0.12);
    INSERT INTO COMPOSITIONPIZZA VALUES (4, 9, 0.05);
    INSERT INTO COMPOSITIONPIZZA VALUES (4, 11, 0.06);
    INSERT INTO COMPOSITIONPIZZA VALUES (5, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (5, 12, 0.1);
    INSERT INTO COMPOSITIONPIZZA VALUES (5, 1, 0.02);
    INSERT INTO COMPOSITIONPIZZA VALUES (5, 11, 0.3);
    INSERT INTO COMPOSITIONPIZZA VALUES (5, 10, 0.5);
    INSERT INTO COMPOSITIONPIZZA VALUES (6, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (6, 12, 0.1);
    INSERT INTO COMPOSITIONPIZZA VALUES (6, 2, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (6, 3, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (6, 4, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (6, 5, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (7, 13, 0.2);
    INSERT INTO COMPOSITIONPIZZA VALUES (7, 12, 0.1);
    INSERT INTO COMPOSITIONPIZZA VALUES (7, 10, 0.04);
    INSERT INTO COMPOSITIONPIZZA VALUES (7, 7, 0.3);

    -- Clients
    INSERT INTO CLIENT (nomClient, prenomClient, mailClient, telClient, mdpClient, numRueAdresseClient, nomAdresseClient, villeAdresseClient, codePostalAdresseClient, infoComplementAdresseClient) VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', '1234567890', 'motdepasse123', '123', 'Rue de la République', 'Paris', '75001', 'Appartement 5, Étage 2');
    INSERT INTO CLIENT (nomClient, prenomClient, mailClient, telClient, mdpClient, numRueAdresseClient, nomAdresseClient, villeAdresseClient, codePostalAdresseClient, infoComplementAdresseClient) VALUES ('Martin', 'Sophie', 'sophie.martin@example.com', '9876543210', 'secret456', '456', 'Avenue des Fleurs', 'Lyon', '69002', '');
    INSERT INTO CLIENT (nomClient, prenomClient, mailClient, telClient, mdpClient, numRueAdresseClient, nomAdresseClient, villeAdresseClient, codePostalAdresseClient, infoComplementAdresseClient) VALUES ('Dubois', 'Pierre', 'pierre.dubois@example.com', '5556667777', 'mdpClient123', '789', 'Boulevard Voltaire', 'Marseille', '13008', 'Porte 10');

    -- Produit
    INSERT INTO PRODUIT (nomProduit, prixUnitaire, quantiteStock, quantiteAlerte, numCategorie) VALUES ('Soda', 2.50, 20, 5, 1);
    INSERT INTO PRODUIT (nomProduit, prixUnitaire, quantiteStock, quantiteAlerte, numCategorie) VALUES ('Eau minérale', 1.50, 15, 3, 1);
    INSERT INTO PRODUIT (nomProduit, prixUnitaire, quantiteStock, quantiteAlerte, numCategorie) VALUES ('Jus d''orange', 3.00, 10, 3, 1);
    INSERT INTO PRODUIT (nomProduit, prixUnitaire, quantiteStock, quantiteAlerte, numCategorie) VALUES ('Tiramisu', 4.50, 10, 3, 2);
    INSERT INTO PRODUIT (nomProduit, prixUnitaire, quantiteStock, quantiteAlerte, numCategorie) VALUES ('Panna cotta', 3.75, 10, 3, 2);
    INSERT INTO PRODUIT (nomProduit, prixUnitaire, quantiteStock, quantiteAlerte, numCategorie) VALUES ('Tarte aux fruits', 5.25, 10, 3, 2);

    -- Alerte
    INSERT INTO ALERTE (dateAlerte, numIngredient, quantiteStock, numProduit) VALUES ('2024-01-17 10:00:00', 2, 4, NULL);
    INSERT INTO ALERTE (dateAlerte, numIngredient, quantiteStock, numProduit) VALUES ('2024-01-18 10:00:00', NULL, 2,  1);
    INSERT INTO ALERTE (dateAlerte, numIngredient, quantiteStock, numProduit)  VALUES ('2024-01-13 10:00:00', NULL, 1, 3);
    INSERT INTO ALERTE (dateAlerte, numIngredient, quantiteStock, numProduit)  VALUES ('2024-01-12 10:00:00', NULL, 2,  4);
    INSERT INTO ALERTE (dateAlerte, numIngredient, quantiteStock, numProduit)  VALUES ('2024-01-14 10:00:00', 13, 1, NULL);
    INSERT INTO ALERTE (dateAlerte, numIngredient, quantiteStock, numProduit)  VALUES ('2024-01-15 10:00:00', 15, 2, NULL);

    -- Livraison
    INSERT INTO LIVRAISON (dateDebutLivraison, dateFinLivraison, numLivreur) VALUES ('2023-12-17 10:00:00', '2023-12-17 10:35:00', 1);
    INSERT INTO LIVRAISON (dateDebutLivraison, dateFinLivraison, numLivreur) VALUES ('2024-01-18 14:30:00', '2024-01-18 15:01:00', 2);
    INSERT INTO LIVRAISON (dateDebutLivraison, dateFinLivraison, numLivreur) VALUES ('2024-01-19 20:15:00', '2024-01-19 20:42:00', 3);
    INSERT INTO LIVRAISON (dateDebutLivraison, dateFinLivraison, numLivreur) VALUES ('2024-01-20 10:05:00', '2024-01-20 10:35:00', 2);
    INSERT INTO LIVRAISON (dateDebutLivraison, dateFinLivraison, numLivreur) VALUES (null, null, 1);
    -- StatutCommande
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('En cours de préparation');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('En attente de paiement');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('Prêt à être livré');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('En cours de livraison');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('Livré');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('Annulé');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('Payé');
    INSERT INTO STATUTPREPARATION (nomStatutPreparation) VALUES ('Commande en cours');

    -- Pizza Special
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (1, 2, 7);
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (2, 3, 7);
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (3, 2, 7);
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (4, 1, 7);
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (5, 1, 7);
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (1, 2, 7);
    INSERT INTO PIZZASPECIALE (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (5, 2, 1);

    -- Composition Pizza Special
    INSERT INTO COMPOSITIONPIZZASPECIALE (numPizzaSpeciale, numIngredient, quantite) VALUES (1, 1, 0);
    INSERT INTO COMPOSITIONPIZZASPECIALE (numPizzaSpeciale, numIngredient, quantite) VALUES (1, 8, 1); -- 1 supplément de jambon
    INSERT INTO COMPOSITIONPIZZASPECIALE (numPizzaSpeciale, numIngredient, quantite) VALUES (1, 10, 0);
    INSERT INTO COMPOSITIONPIZZASPECIALE (numPizzaSpeciale, numIngredient, quantite) VALUES (6, 1, -1);

    -- ModePaiement
    INSERT INTO MODEPAIEMENT (nomModePaiement) VALUES ('Borne');
    INSERT INTO MODEPAIEMENT (nomModePaiement) VALUES ('En ligne');
    INSERT INTO MODEPAIEMENT (nomModePaiement) VALUES ('En Caisse');

    -- Commande
    INSERT INTO COMMANDE (dateDebutCommande, dateFinCommande, numLivraison, numClient, numModePaiement, numStatutCommande) VALUES ('2023-12-09 9:50:00', '2023-12-09 10:35:00', 1, 1, 1, 5);
    INSERT INTO COMMANDE (dateDebutCommande, dateFinCommande, numLivraison, numClient, numModePaiement, numStatutCommande) VALUES ('2024-01-11 14:15:00', '2024-01-11 15:01:00', 2, 2, 1, 5);
    INSERT INTO COMMANDE (dateDebutCommande, dateFinCommande, numLivraison, numClient, numModePaiement, numStatutCommande) VALUES ('2024-01-19 20:00:00', '2024-01-19 20:42:00', 3, 3, 1, 5);
    INSERT INTO COMMANDE (dateDebutCommande, dateFinCommande, numLivraison, numClient, numModePaiement, numStatutCommande) VALUES ('2024-01-20 09:50:00', '2024-01-20 10:35:00', 4, 1, 1, 5);
    INSERT INTO COMMANDE (dateDebutCommande, dateFinCommande, numLivraison, numClient, numModePaiement, numStatutCommande) VALUES ('2024-01-20 20:00:00', null, 5, 2, 1, 1);

    -- Paiement
    INSERT INTO PAIEMENT (numClient, numCommande, numcarteBleu, cryptoCarteBleu, dateExpiration, datePaiement) VALUES (1, 1, '1234567890123456', '123', '2024-12-31 23:59:59', '2024-01-18 12:34:56');
    INSERT INTO PAIEMENT (numClient, numCommande, numcarteBleu, cryptoCarteBleu, dateExpiration, datePaiement) VALUES (2, 2, '9876543210987654', '456', '2024-10-15 18:45:00', '2024-01-18 15:45:30');
    INSERT INTO PAIEMENT (numClient, numCommande, numcarteBleu, cryptoCarteBleu, dateExpiration, datePaiement) VALUES (3, 3, '1111222233334444', '789', '2025-05-01 00:00:00', '2024-01-18 20:15:00');

    -- Commande Produit
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (1, 1, 1);
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (1, 4, 2);
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (2, 1, 2);
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (3, 1, 1);
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (3, 2, 1);
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (4, 1, 1);
    INSERT INTO COMMANDEPRODUIT (numCommande, numProduit, quantiteProduit) VALUES (5, 2, 1);


    -- Selection
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (1, 1);
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (2, 1);
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (3, 2);
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (4, 2);
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (5, 3);
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (6, 4);
    INSERT INTO SELECTION (numPizzaSpeciale, numCommande) VALUES (7, 5);

    -- Reduction
    INSERT INTO REDUCTION (nomReduction, pourcentageReduction, estUtilisee, dateFin, numCommandeSource, numCommandeReduite, numClient) VALUES ('50%',0.50, 0, '2024-07-18 00:00:00', 2, NULL, 2);

    -- Gestionnaire
    INSERT INTO GESTIONNAIRE (nomGestionnaire, prenomGestionnaire, mailGestionnaire, mdpGestionnaire) VALUES ('Smith', 'John', 'john.smith@example.com', 'password123');
    INSERT INTO GESTIONNAIRE (nomGestionnaire, prenomGestionnaire, mailGestionnaire, mdpGestionnaire) VALUES ('Taylor', 'Emma', 'emma.taylor@example.com', 'secure456');
    INSERT INTO GESTIONNAIRE (nomGestionnaire, prenomGestionnaire, mailGestionnaire, mdpGestionnaire) VALUES ('Brown', 'Michael', 'michael.brown@example.com', 'mdpGestion123');