SELECT m.nom_manga , m.titre_manga , m.titre_original_manga , m.titres_alternatifs_manga , c.nom_classification classification , m.tomes_vf_manga tomes_vf   , sf.nom_statut statut_vf , m.tomes_vo_manga tomes_vo , so.nom_statut statut_vo , s.nom_support , m.date_maj_manga , p.nom_pays pays, m.annee_vo_manga sortie_vo , m.annee_vf_manga sortie_vf, m.image_manga , m.arriere_plan_manga arriere_plan , m.synopsis_manga FROM manga m
	JOIN statut sf ON m.id_statut_vf = sf.id_statut JOIN statut so ON m.id_statut_vo = so.id_statut JOIN support s ON m.id_support = s.id_support JOIN pays p ON p.id_pays = m.id_pays JOIN classification c ON c.id_classification = m.id_classification;
    
SELECT a.nom_anime , a.titre_anime , a.titre_original_anime , a.titres_alternatifs_anime , c.nom_classification classification , a.saisons_anime , a.episodes_anime , s.nom_statut , a.date_maj_anime , sp.nom_saison_parution saison , a.annee_anime anneee, a.image_anime , a.arriere_plan_anime arriere_plan , t.nom_type_anime `type` , a.synopsis_anime FROM anime a
	JOIN statut s ON a.id_statut = s.id_statut JOIN saison_parution sp ON sp.id_saison_parution = a.id_saison_parution JOIN classification c ON c.id_classification = a.id_classification JOIN type_anime t ON t.id_type_anime = a.id_type_anime;
    
SELECT m.nom_manga , t.numero_tomes , a.nom_arc , t.image_tomes , t.synopsis_tomes FROM manga m JOIN tomes t ON t.id_manga = m.id_manga LEFT JOIN arc a ON a.id_arc = t.id_arc ;
SELECT m.nom_manga , t.numero_tomes , a.nom_arc , t.image_tomes , t.synopsis_tomes FROM manga m JOIN tomes t ON t.id_manga = m.id_manga LEFT JOIN arc a ON a.id_arc = t.id_arc 
	WHERE m.nom_manga = 'SwordArtOnline';
    
SELECT a.nom_anime , s.numero_saisons , s.nom_saisons , s.image_saisons , s.synopsis_saisons FROM anime a JOIN saisons s ON s.id_anime = a.id_anime ;
SELECT a.nom_anime , s.numero_saisons , s.nom_saisons , s.image_saisons , s.synopsis_saisons FROM anime a JOIN saisons s ON s.id_anime = a.id_anime 
	WHERE a.nom_anime = 'SwordArtOnline';

/*
SELECT m.nom_manga , ml.nom_manga manga_lie , tr.nom_type_relation relation FROM manga m 
	JOIN manga_manga mm ON m.id_manga = mm.id_manga_preneur OR m.id_manga = mm.id_manga_preneur
    JOIN manga ml ON ml.id_manga = CASE WHEN m.id_manga = mm.id_manga_preneur THEN mm.id_manga_donneur ELSE mm.id_manga_preneur END
    JOIN type_relation tr ON tr.id_type_relation = CASE WHEN m.id_manga = mm.id_manga_preneur THEN mm.id_type_relation ELSE mm.id_type_relation_inverse END
    ORDER BY m.nom_manga, ml.nom_manga;
*/

SELECT
    m1.nom_manga,
    m2.nom_manga AS nom_manga_lie,
    tr.nom_type_relation AS relation
FROM manga_manga mm
JOIN manga m1 ON m1.id_manga = mm.id_manga_preneur
JOIN manga m2 ON m2.id_manga = mm.id_manga_donneur
JOIN type_relation tr ON tr.id_type_relation = mm.id_type_relation

UNION ALL

SELECT
    m2.nom_manga,
    m1.nom_manga AS nom_manga_lie,
    tr.nom_type_relation AS relation
FROM manga_manga mm
JOIN manga m1 ON m1.id_manga = mm.id_manga_preneur
JOIN manga m2 ON m2.id_manga = mm.id_manga_donneur
JOIN type_relation tr ON tr.id_type_relation = mm.id_type_relation_inverse

ORDER BY nom_manga, nom_manga_lie;