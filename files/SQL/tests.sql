SELECT m.nom_manga , m.tomes_vf_manga , sf.nom_statut statut_vf , m.tomes_vo_manga , so.nom_statut statut_vo FROM manga m
	JOIN statut sf ON m.id_statut_vf = sf.id_statut JOIN statut so ON m.id_statut_vo = so.id_statut ;
    
SELECT m.nom_manga , t.numero_tomes , a.nom_arc , synopsis_tomes FROM manga m JOIN tomes t ON t.id_manga = m.id_manga LEFT JOIN arc a ON a.id_arc = t.id_arc ;

SELECT m.nom_manga , ml.nom_manga manga_lie , tr.nom_type_relation relation FROM manga m 
	JOIN manga_manga mm ON m.id_manga = mm.id_manga_preneur OR m.id_manga = mm.id_manga_preneur
    JOIN manga ml ON ml.id_manga = CASE WHEN m.id_manga = mm.id_manga_preneur THEN mm.id_manga_donneur ELSE mm.id_manga_preneur END
    JOIN type_relation tr ON tr.id_type_relation = CASE WHEN m.id_manga = mm.id_manga_preneur THEN mm.id_type_relation ELSE mm.id_type_relation_inverse END
    ORDER BY m.nom_manga, ml.nom_manga;