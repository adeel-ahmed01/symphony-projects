--
-- Déchargement des données de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id`, `titre`, `editeur`) VALUES
(1, 'Le rouge et le noir', 'Bourgois'),
(2, 'PHP pour les nuls', 'EditionFirst'),
(3, 'Atlas du monde', 'EditionAtlas'),
(4, 'Le seigneur des anneaux', 'Bourgois'),
(5, 'La vie de Margaret Machintruc', 'EditionFr');


--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Roman'),
(2, 'Informatique'),
(3, 'Géographie');

--
-- Déchargement des données de la table `oeuvre_categorie`
--

INSERT INTO `oeuvre_categorie` (`oeuvre_id`, `categorie_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1),
(5, 1);
