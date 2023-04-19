INSERT INTO "images"(path) VALUES
('img/topic_logo/homepage/temp.png'),
('img/topic_logo/homepage/dei_icones_homepage-133.png'),
('img/topic_logo/homepage/dei_icones_homepage-134.png'),
('img/topic_logo/homepage/dei_icones_homepage-135.png'),
('img/topic_logo/homepage/dei_icones_homepage-136.png'),
('img/topic_logo/homepage/dei_icones_homepage-137.png'),
('img/topic_logo/homepage/dei_icones_homepage-138.png'),
('img/topic_logo/homepage/dei_icones_homepage-139.png'),
('img/topic_logo/icons/dei_temas_-132.png'),
('img/topic_logo/icons/dei_temas_-127.png'),
('img/topic_logo/icons/dei_temas_-130.png'),
('img/topic_logo/icons/dei_temas_-128.png'),
('img/topic_logo/icons/dei_temas_-129.png'),
('img/topic_logo/icons/dei_temas_-131.png'),
('img/topic_logo/icons/dei_temas_-133.png');

INSERT INTO "users"(name, email, email_verified_at, password, remember_token, created_at, updated_at, role) VALUES 
('Fábio Huang', 'up201806829@up.pt', '2022-04-16 20:18:16', '$2y$10$eM9Cu3Peeu7GVeJnKZpj5uN90yG3nEkR9kctVyNMAHC8x6.gO6O3e', DEFAULT, '2022-04-16 20:18:16', '2022-04-16 20:18:16','Admin'),
('Ivo Ribeiro', 'up201307718@up.pt', '2022-04-16 20:18:16', '$2y$10$eM9Cu3Peeu7GVeJnKZpj5uN90yG3nEkR9kctVyNMAHC8x6.gO6O3e', DEFAULT, '2022-04-16 20:18:16', '2022-04-16 20:18:16','Admin'),
('Pedro Pacheco', 'up201806824@up.pt', '2022-04-16 20:18:16', '$2y$10$eM9Cu3Peeu7GVeJnKZpj5uN90yG3nEkR9kctVyNMAHC8x6.gO6O3e', DEFAULT, '2022-04-16 20:18:16', '2022-04-16 20:18:16','Admin'),
('Vasco Garcia', 'up201805255@up.pt', '2022-04-16 20:18:16', '$2y$10$eM9Cu3Peeu7GVeJnKZpj5uN90yG3nEkR9kctVyNMAHC8x6.gO6O3e', DEFAULT, '2022-04-16 20:18:16', '2022-04-16 20:18:16','Admin');

INSERT INTO "topics"( order_id, title, created_at, updated_at, homepage_image_id, icon_image_id) VALUES 
( 1, 'O Meu Departamento', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 2,9),
( 2, 'Serviços FEUP', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 3, 10),
( 3, 'Apoio e Bem-estar', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 4, 11),
( 4, 'Recursos', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 5, 12),
( 5, 'Núcleos e Mentoria', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 6, 13),
( 6, 'Participação Cívica', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 7, 14),
( 7, 'Código de Conduta Académica', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 8, 15);

INSERT INTO "questions"(topic_id,order_id, content) VALUES 
(1,1, 'O Luís precisa de ir à Secretaria do seu curso. 
Ajuda o Luís a encontrar a Secretaria do Departamento selecionando a opção com o piso e sala corretos:'),
(1,2, 'O Luís vai conhecer um projeto de doutoramento na área da Realidade Aumentada, desenvolvido num dos laboratórios do DEI. 
A que laboratório se deve dirigir?'),
(1,3, 'Ajuda o Luís a identificar as siglas corretas dos cursos a que a Secretaria do DEI presta apoio:'),
(2,1, 'O Luís costuma fazer o pagamento das suas propinas através da sua conta corrente. Na impossibilidade de o fazer desta forma, onde terá o Luís de se dirigir para regularizar a sua situação?'),
(2,2, 'Quais são as competências principais dos Serviços Académicos da FEUP?'),
(2,3, 'O Luís pretende fazer ERASMUS em Itália no próximo semestre. Qual o gabinete que deve contactar?'),
(2,4, 'O Luís quer pagar as suas propinas. Como deve proceder?'),
(2,5, 'Quando o Luís acabar o curso, onde é que pode solicitar o seu certificado e/ou diploma?'),
(2,6, 'O Certificado que o Luís pediu, onde pode ser levantado?'),
(3,1, 'O Luís tem um primo que se desloca numa cadeira de rodas, e que pretende entrar na L.EIC no próximo ano letivo. Para obter mais esclarecimentos, contactou o NAI - Núcleo de Apoio à Inclusão, da U.Porto. Qual é a principal competência deste gabinete?'),
(3,2, 'O Luís anda muito ansioso e já teve vários ataques de pânico. Para tentar perceber como poderia resolver o problema, dirigiu-se ao:'),
(3,3, 'O seguro escolar é de pagamento obrigatório no início do ano letivo e cobre vários tipos de acidentes. Em que condições é que o seguro escolar não pode ser acionado?'),
(4,1, 'O Cartão U.Porto pode ser requisitado através da página pessoal do estudante no SIGARRA. Que vantagem o Luís pode ter em utilizá-lo?'),
(4,2, 'Depois de ter pago a primeira prestação de propinas, o Luís teve um carregamento gratuito no seu cartão de Estudante U.Porto. Qual o saldo inicial a que teve direito?'),
(5,1, 'Qual o nome do programa de acolhimento da FEUP para os novos estudantes como o Luís?'),
(5,2, 'Começaram as aulas há algum tempo e o Luís sente que precisa de ajuda para perceber conteúdos de algumas disciplinas. Vai recorrer ao projeto Mentoria Interpares. Quem será o seu mentor?'),
(5,3, 'O Luís ouviu falar sobre os núcleos associados ao DEI e perguntou a um colega para que serviam. O que achas que o colega respondeu?'),
(5,4, 'Anualmente, um destes núcleos organiza uma Game Jam. De que núcleo se trata?'),
(6,1, 'Os Comissariados são importantes estruturas que vão permitir ao Luís estreitar relações com colegas, técnicos e docentes de faculdade para além das aulas. Qual dos seguintes comissariados está associado à FEUP?'),
(6,2, 'Que dois projetos musicais fazem parte do Comissariado Cultural?'),
(7,1, 'Segundo o Regulamento Disciplinar dos estudantes da U.Porto são considerados processos fraudulentos:'),
(7,2, 'As sanções aplicáveis aos estudantes são as seguintes: a) A advertência. b) A multa. c) A suspensão temporária de atividades escolares. d) A suspensão da avaliação escolar durante um ano letivo. e) A interdição da frequência da Universidade e suas unidades de ensino, de investigação ou de prestação de serviços, até 5 anos letivos. A sanção disciplinar de suspensão temporária das atividades escolares consiste na proibição de frequência das aulas e da prestação das provas académicas, num período:'),
(7,3, 'A sanção disciplinar de advertência é aplicável nomeadamente quando:');

INSERT INTO "answers"(question_id, content, order_id) VALUES
(1, 'Edifício I, Piso 1, Sala 124',1),(1, 'Edifício B, Piso 2, Sala 220',2),(1, 'Edifício I, Piso 0, Sala 012',3),
(2, 'Laboratório de Sistemas de Computação Gráfica Avançada',1),(2, 'Laboratório de Computação Gráfica, Interação e Jogos',2),(2, 'Laboratório de Media Digitais',3),
(3, 'L.EIC, M.EIC, MESW, MECD, MM, MCI, LCI, ProDEI, PDMD',1),(3, 'L.EIC, M.EIC, MESW, MEDC, MM, MCI, LSI, ProDEI, PDMD',2),(3, 'L.EIC, M.EIC, MESW, MECC, MM, MCI, LSI, ProDEI, PDMD',3),
(4, 'Secretaria do DEI', 1),(4, 'Tesouraria', 2),(4, 'Serviços Académicos', 3),
(5, 'Esclarecer e acompanhar o estudante, de uma forma mais personalizada, sobre informações relacionadas com o seu curso, desde a inscrição inicial.', 1),(5, 'Gerir todas as questões ligadas ao ingresso, à certificação e à gestão do percurso do estudante, como matrículas, inscrições, certidões, requerimentos, exames, creditação, entre outros.', 2),(5, 'Tratar apenas das questões relacionadas com os Programas de Intercâmbio Académico.',3),
(6, 'Núcleo de Mentoria Internacional', 1),(6, 'Intercultural Contact Point (iPoint)', 2),(6, 'COOP - Captação e Cooperação Académica', 3),
(7, 'Pagar em dinheiro, presencialmente, pois a Tesouraria apenas aceita esta modalidade de pagamento.', 1),(7, 'Pagar através de referência MB, na opção “conta corrente”, disponível na página pessoal do SIGARRA.', 2),(7, 'Pagar através de transferência bancária.',3),
(8, 'Na sua página pessoal, opção "Certificados"',1),(8, 'Na sua página pessoal, através da opção "Diplomas"', 2),(8, 'Presencialmente, nos Serviços Académicos.',3),
(9, 'Secretaria do DEI',1),(9, 'Tesouraria',2),(9, 'Serviços Académicos',3),
(10, 'Avaliar e resolver problemas de acessibilidades físicas, tanto no espaço da Universidade como nas zonas circundantes.', 1), (10, 'Promover sessões de esclarecimento sobre os apoios sociais disponíveis.', 2), (10, 'Emitir pareceres técnicos sobre as condições de acessibilidade apenas do complexo de edifícios da FEUP.', 3),
(11, 'NAI - Núcleo de Apoio à Inclusão', 1), (11, 'GOI - Gabinete de Orientação e Integração', 2), (11, 'GAI - Gabinete de Apoio e Integração', 3),
(12, 'Atividades escolares regulares, incluindo aulas, visitas de estudo, aulas ao ar livre, estágios ligados à atividade escolar.', 1), (12, 'Viagens no percurso normal de ida e volta da residência para a escola. ', 2), (12, 'Doença ou acidentes ocorridos fora do âmbito escolar.', 3),
(13, 'Ter descontos nos transportes públicos (metro e autocarro).',1),(13, 'Aceder ao parque de estacionamento da Faculdade.',2),(13, 'Fazer carregamentos para refeições na cantina escolar.',3),
(14, '2 euros',1),(14, '5 euros',2),(14, '10 euros', 3),
(15, 'Projeto Mentoring',1),(15, 'Peer Mentoring Program',2),(15, 'Programa Mentoria Interpares',3),
(16, 'Um professor',1),(16, 'Um colega',2),(16, 'Um alumnus',3),
(17, 'Para ajudar na integração dos estudantes',1),(17, 'Para organizar simpósios e painéis de discussão',2),(17, 'Todas as opções anteriores',3),
(18, 'Núcleo de Informática da AEFEUP',1),(18, 'IEEE University of Porto Student Branch',2),(18, 'Núcleo Estudantil de Computação Gráfica e Multimédia',3),
(19, 'Comissariado Cultural',1),(19, 'Comissariado Social e Vocacional',2),(19, 'Comissariado para a Integração de Novos Estudantes',3),
(20, 'Orquestra Clássica da FEUP e Grupo de Jazz da FEUP',1),(20, 'Orquestra Clássica da FEUP e Grupo de Fados da FEUP',2),(20, 'Orquestra Filarmónica da FEUP e Grupo de Jazz da FEUP',3),
(21, 'A obtenção fraudulenta de enunciados, a cópia ou o plágio, a cábula, apresentar como suas ideias ou trabalhos de outros sem indicação das respetivas fontes',1),(21, 'Permitir que algum dos seus trabalhos seja apresentado como sendo de outra pessoa, dar ou receber ajuda de um outro estudante durante uma avaliação',2),(21,'Todos os acima indicados',3),
(22, 'que pode variar entre 7 e 90 dias',1),(22, 'que pode variar entre 3 e 100 dias',2),(22, 'que pode variar entre 3 e 120 dias',3),
(23, 'Existiu dolo',1),(23, 'O estudante já foi administrativamente penalizado, nomeadamente pela anulação de testes ou de exames',2),(23, 'O estudante é reincidente em infrações leves e de pouca gravidade',3);

UPDATE "questions" SET correct_answer_id = 3 WHERE id = 1; -- C
UPDATE "questions" SET correct_answer_id = 5 WHERE id = 2; -- B
UPDATE "questions" SET correct_answer_id = 7 WHERE id = 3; -- A
UPDATE "questions" SET correct_answer_id = 11 WHERE id = 4; -- B
UPDATE "questions" SET correct_answer_id = 14 WHERE id = 5; -- B
UPDATE "questions" SET correct_answer_id = 18 WHERE id = 6; -- C
UPDATE "questions" SET correct_answer_id = 20 WHERE id = 7; -- B
UPDATE "questions" SET correct_answer_id = 22 WHERE id = 8; -- A
UPDATE "questions" SET correct_answer_id = 27 WHERE id = 9; -- C
UPDATE "questions" SET correct_answer_id = 28 WHERE id = 10; -- A
UPDATE "questions" SET correct_answer_id = 32 WHERE id = 11; -- B
UPDATE "questions" SET correct_answer_id = 36 WHERE id = 12; -- C
UPDATE "questions" SET correct_answer_id = 38 WHERE id = 13; -- B
UPDATE "questions" SET correct_answer_id = 41 WHERE id = 14; -- B
UPDATE "questions" SET correct_answer_id = 45 WHERE id = 15; -- C
UPDATE "questions" SET correct_answer_id = 47 WHERE id = 16; -- B
UPDATE "questions" SET correct_answer_id = 51 WHERE id = 17; -- C
UPDATE "questions" SET correct_answer_id = 54 WHERE id = 18; -- C
UPDATE "questions" SET correct_answer_id = 55 WHERE id = 19; -- A
UPDATE "questions" SET correct_answer_id = 58 WHERE id = 20; -- A
UPDATE "questions" SET correct_answer_id = 63 WHERE id = 21; -- C
UPDATE "questions" SET correct_answer_id = 65 WHERE id = 22; -- B
UPDATE "questions" SET correct_answer_id = 68 WHERE id = 23; -- B

INSERT INTO "posts"( topic_id,order_id, title , created_at, updated_at, content) VALUES 
(1,1, 'O DEPARTAMENTO DE ENGENHARIA INFORMÁTICA', '2022-04-16 20:18:16', '2022-04-16 20:18:16', 
'<p><span style="color: rgb(255, 255, 255);">O Departamento de Engenharia Informática da FEUP propõe-se:
<br>
O DEI iniciou as suas atividades a 1 de janeiro de 2008 com 38 docentes, envolvidos em matérias científicas e técnicas que são abrangidas pela
classificação dos Corpos de Conhecimento ("Bodies of Knowledge") incluídos na proposta curricular das organizações ACM e IEEE (CC2001).
<br>
Atualmente o Departamento é constituído por um corpo técnico de 5 membros e um corpo docente de 55 membros, 35 dos quais doutorados, que desenvolvem as
suas atividades nas seguintes Subáreas:</span></p>'), -- 1

(1,2,'MAPA GERAL DAS INSTALAÇÕES', '2022-04-16 20:18:16', '2022-04-16 20:18:16',''), -- 2

(2,1,'SERVIÇOS ACADÉMICOS', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Os Serviços Académicos da FEUP, também conhecidos como secretaria central,
ficam situados no átrio principal da FEUP, ao lado do Infodesk. As suas
áreas de atuação estão ligadas ao ingresso, à certificação e à gestão do
percurso do estudante. A maior parte da informação nas áreas de atuação
destes serviços, estão disponíveis no separador “estudantes”, menu do lado
esquerdo no website da FEUP. Lá encontras toda a informação sobre
matrículas, inscrições, certidões, requerimentos, exames, creditação,
estatutos especiais, prescrições, entre outras, necessária para que consigas
gerir o teu percurso na FEUP.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/uni_geral.unidade_view?pv_unidade=73">Serviços Académicos</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/web_base.gera_pagina?p_pagina=ESTUDANTES">Estudantes</a></span></p>
'), -- 3

(2,2,'SERVIÇOS DE IMAGEM, COMUNICAÇÃO E COOPERAÇÃO', '2022-04-16 20:18:16', '2022-04-16 20:18:16'
,'<p><span style="color: rgb(255, 255, 255);">Se tiveres interesse em fazer mobilidade internacional, poderás contactar o
gabinete de Mobilidade OUT e seguir um dos seguintes passos:</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/web_base.gera_pagina?p_pagina=mobilidade%20internacional">Mobilidade Internacional</a></span></p>
'), -- 4

(2,3,'TESOURARIA', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">A tesouraria está a tentar desmaterializar os pagamentos pelo que
conseguirás à partida fazer todos os pagamentos online, gerando referência
MB através da opção “conta corrente” que encontras na tua página pessoal. Se
mesmo assim precisares de ir à Tesouraria, encontras aqui a localização e
horário de funcionamento.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/uni_geral.unidade_view?pv_unidade=1243">Unidade de Tesouraria</a></span></p>
'), -- 5

(3,1, 'INTEGRAÇÃO E ACESSIBILIDADE', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Acolhemos a diversidade de braços abertos. No GOI e no NAI encontras
aconselhamento para o teu bem-estar e integração.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/uni_geral.unidade_view?pv_unidade=892">Gabinete de Orientação e Integração</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/up/pt/web_base.gera_pagina?p_pagina=1037937">Estudantes: Áreas de Intervenção</a></span></p>
'), -- 6

(3,2, 'ESTUDANTES INTERNACIONAIS', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">O Intercultural Contact Point (iPoint) centra a sua atividade no acolhimento
e integração dos estudantes internacionais de Mestrado e Doutoramento,
promovendo a integração de todos os estudantes num ambiente académico
diversificado e saudável. Se és estudante internacional visita-os! + info</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://paginas.fe.up.pt/~ipoint/">iPoint</a></span></p>
'), -- 7

(3,3, 'PROGRAMAS DE ATIVIDADE FÍSICA', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Não há desculpa para não ficar em forma. Lembra-te que a saúde física e a
saúde mental são ambas essenciais para o teu bem-estar. + info</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://cdup.up.pt/">CDUP</a></span></p>
'), -- 8

(3,4, 'ESPAÇOS DE RESTAURAÇÃO / EMENTA DO DIA', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">5 restaurantes ao teu dispor no Campus FEUP.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/cantina.ementashow#8">Cantina FEUP</a></span></p>
'), -- 9

(3,5, 'SASUP', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Serviços de Ação Social da Universidade do Porto.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/sasup/pt/web_page.inicial">SASUP</a></span></p>
'), -- 10

(3,6, 'SEGURO ESCOLAR', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Todos os estudantes no início de cada ano letivo têm que pagar, juntamente
com a 1a prestação de propinas, €2 de seguro escolar.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/up/pt/web_base.gera_pagina?p_pagina=seguros">Estudantes Internacionais - Informação Útil</a></span></p>
'), -- 11

(3,7, 'AEFEUP', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">A Associação de Estudantes existe há 30 anos e dedica-se à defesa dos
direitos dos estudantes da FEUP nas diversas facetas da sua vida académica.
Fazem parte da associação vários núcleos onde te podes envolver e são
organizados inúmeros eventos ao longo do ano letivo.
<br>
A AEFEUP dá-te também a oportunidade de, ao mesmo tempo, praticares desporto
e representares a Faculdade nos Campeonatos Académicos do Porto (CAP),
organizados pela Federação Académica do Porto (FAP) ou nos Campeonatos
Nacionais Universitários (CNU), organizados pela Federação Académica de
Desporto Universitário (FADU).
<br>
A FEUP tem seleções nos seguintes desportos:</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.aefeup.pt/">AEFEUP</a></span></p>
'), -- 12

(3,8, 'BOLSAS', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">A FEUP tem várias bolsas de investigação disponíveis um conjunto de
oportunidades divulgadas por empresas inscritas na Bolsa de Emprego da FEUP.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/noticias_geral.lista_noticias?p_grupo_noticias=19">Notícias FEUP</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/WEB_BASE.GERA_PAGINA?P_pagina=19498">Bolsa de Emprego FEUP</a></span></p>
'), -- 13

(4,1, 'SERVIÇOS DE IMPRESSÃO', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Quando receberes o teu cartão e assim que o pagamento da 1a prestação de
propinas for efetuado, terás um saldo inicial de €5. Quando esgotares o teu
saldo, poderás fazer um carregamento através da tua página pessoal.
<br>
Vai ao menu do lado direito > impressões > gerar referência e terás à tua
disposição impressoras em todos os edifícios da faculdade. Podes efetuar os
teus trabalhos de impressão e encadernação, bem como impressão de materiais
gráficos como posters no  Centro de Impressões.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/it/pt/servicos/impressao/impressao-web-0d53fb76">Impressão Web</a></span></p>
'), -- 14

(4,2, 'CARTÃO U.PORTO', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Podes pedir o teu cartão U.Porto a partir da tua página pessoal > menu do
lado direito. Quando receberes a notificação que o cartão pode ser
levantado, deverás ir ao InfoDesk - Edifício A, Piso 0, junto à Entrada
Principal.
<br>
São muitas as vantagens do teu cartão U.Porto:</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/cartao_geral.cartao_uporto">Página pessoal do Cartão U.PORTO</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/up/pt/web_base.gera_pagina?p_pagina=1001861">Vantagens ao dispor da Comunidade Académica</a></span></p>
'), -- 15

(4,3, 'CONTATOS E HORÁRIO', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">InfoDesk: (Tel.: +351 225 081 400 | 2a a 6a feira | 09:00 - 13:00 / 14:00 -
17:30).</span></p>
<br>
'), -- 16

(4,4, 'PASSE SUB23 ANDANTE', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">O Passe Sub23 é um cartão de transporte destinado aos estudantes do Ensino
Superior até aos 23 anos (inclusive), que permite um desconto na aquisição
do passe de acesso aos transportes intermodais do Porto. Vais precisar da
Declaração oficial Sub23 emitida pelos Serviços Académicos da FEUP, assinada
e carimbada. Para tal tens que seguir o procedimento aqui descrito. Para
renovares a tua assinatura deves aceder ao site estudante.tip.pt +info</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/web_base.gera_pagina?p_pagina=179878">SUB23@SUPERIOR.TP</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/feup/pt/web_gessi_docs.download_file?p_name=F1078163332/Procedimento_Pedido%20de%20Declara%E7%E3o%20sub23.pdf">Explicação sobre processo de obtenção de Declaração SUB23</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.linhandante.com/pt/web/tip/w/andante-sub23">Página Andante SUB23</a></span></p>
'), -- 17

(4,5, 'BIBLIOTECAS UP', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Podes requisitar livros, artigos e outros recursos úteis como Bases de
Dados, Dicionários e Enciclopédias, E-books, Legislação, Revistas
Científicas, Teses,etc. , não só na FEUP como nas outras Faculdades da
U.Porto.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/it/pt/servicos/arquivos-bibliotecas-e-repositorios/solicitar-livros-artigos-e-outros-recursos-640f8cf5">Solicitar Livros, Artigos e Outros Recursos</a></span></p>
'), -- 18

(4,6, 'SOFTWARE', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">A U.Porto licencia e disponibiliza algumas aplicações de interesse,
transversal à comunidade académica. Para apoio nesta área contacta:
helpdesk@uporto.pt.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/it/pt/servicos/software/comunidade-academica-6b85ae1d">Comunidade Académica</a></span></p>
'), -- 19

(4,7, 'EQUIPAMENTO AUDIOVISUAL', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Os estudantes do DEI, no âmbito dos seus trabalhos académicos, têm ao seu
dispor vários equipamentos audiovisuais, que podem ser reservados através do
Sistema Booked. Para algum esclarecimento, envia as tuas dúvidas para
avmedia.dei@fe.up.pt.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://web.fe.up.pt/~avmediadei/booked/Web/dashboard.php">Booked</a></span></p>
'), -- 20

(4,8, 'FERRAMENTAS EDUCATIVAS', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Subscrevemos a Cloud da Google, pelo que podes ter acesso a mais espaço e
ferramentas de trabalho colaborativo. +info
<br>
O Moodle é a principal ferramenta de e-learning da nossa Universidade. +info
<br>
Como podes aceder ao Moodle via SIGARRA?
<br>
Também podes alterar e recuperar password. +info</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/it/pt/servicos/contas-e-passwords/google-for-education-94a08d3c">Google for Education</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/it/pt/servicos/apoio-ao-ensino/moodle-f261a767">Moodle</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/it/pt/servicos/contas-e-passwords/alterarrecuperar-password-dca96287">Alterar/Recuperar Password</a></span></p>
'), -- 21

(5,1, 'PROGRAMA MENTORIA INTERPARES', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Chegar a uma faculdade tão grande pode ser um pouco intimidante e gerar
alguma ansiedade. O programa de Mentoria Interpares foi criado para
facilitar a vida a quem chega de novo. Colegas mais velhos ajudar-te-ão no
período de adaptação e não te sentirás tão perdido. No ano seguinte, poderás
ser tu o Mentor e retribuir! + info</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://paginas.fe.up.pt/~mentoriafeup/">Mentoria FEUP</a></span></p>
'), -- 22

(5,2, 'NÚCLEOS', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">Os núcleos ligados ao DEI servem como uma porta de entrada para fóruns,
painéis de discussão e simpósios que promovem não só o teu desenvolvimento
profissional, como competências interpessoais, cada vez mais valorizadas no
mercado de trabalho. Se és estudante e procuras desenvolver capacidades
extracurriculares, deixamos-te o desafio.
<br>
Junta-te a uma das equipas!</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://paginas.fe.up.pt/~mentoriafeup/">Mentoria FEUP</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://ni.fe.up.pt/">NIAEFEUP</a></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://ieee.fe.up.pt/?pk_campaign=Redirect&pk_source=ieeept">IEEE</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.facebook.com/acmfeup/">ACMFEUP</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://ncgm.fe.up.pt/pt/home">NCGM</a></span></p>
'), -- 23

(6,1, 'COMUNIDADE FEUP', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">A vida no campus não se limita ao estudo e às aulas. Existem vários
comissariados que foram criados a pensar no enriquecimento da comunidade
FEUP em variadas vertentes, havendo um incentivo para que esta se envolva
nas atividades por eles promovidas.
<br>
Há um número crescente de estudantes que participam em iniciativas de
voluntariado, a partir de organizações sediadas nas diferentes Faculdades da
Universidade e em ligação com a comunidade envolvente. A satisfação pessoal
sentida pelos estudantes quando disponibilizam algum do seu tempo em prol do
bem comum faz com que procurem organizações para praticar ações de
voluntariado. Podes ver aqui algumas dessas organizações e contactar o
Comissariado Social da FEUP para mais informação.</span></p>
<br>
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://paginas.fe.up.pt/~respsocial/">Responsabilidade Social</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://paginas.fe.up.pt/~sustent/comissariado/missao-e-visao/">Missão e Visão</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://drive.google.com/file/d/1cpvu2jb7QcVdlZCE92c6WMFPa_hKNNTZ/view">Voluntariado U.PORTO</a></span></p>
'), -- 24

(7,1, 'ÉTICA', '2022-04-16 20:18:16', '2022-04-16 20:18:16',
'<p><span style="color: rgb(255, 255, 255);">A U.Porto e todas as suas faculdades, 
defendem uma cultura orientada por valores e princípios como honestidade, integridade e rigor científico, 
que tem subjacente o comportamento ético de todos os membros da comunidade académica.
<br>
Condena todas as formas de desonestidade académica e as más práticas científicas, entre as quais se enquadra o plágio.
<br>
O Código Ético de Conduta Académica da U.Porto (2017) estabelece os princípios de conduta ética aplicados a toda a comunidade académica 
(docente, investigadores, estudante, bolseiros e colaboradores), do qual se destaca, em particular, as partes dedicadas ao plágio:
<br>
</span></p>
<br>
Capítulo V - Normas de boa conduta dos estudantes
<br>
Artigo 13º - alíneas g), h), i) j) - item i) a iv)
<br>
É particularmente importante que conheças o Regulamento Disciplinar dos estudantes da U.Porto, o qual refere no seu artº 4º alínea l) subalínea ii) que o estudante deve:
<br>
l) Abster-se de recorrer a processos fraudulentos, tais como:
<br>
ii. a cópia ou o plágio<br>
O incumprimento e desrespeito por estas regras, dá origem a sanções que poderão variar consoante a gravidade da situação em causa.
<p><span style="color: rgb(255, 255, 255);">Links úteis</span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://sigarra.up.pt/ffup/pt/web_gessi_docs.download_file?p_name=F1080012025/GR_03_07_2011_Regulamento_Disciplinar_Estudantes.pdf">Regulamento Disciplinar dos Estudantes U.PORTO</a></span></p>
<p><span style="text-decoration: underline;"><a target="_blank" style="color: rgb(53, 152, 219);" href="https://www.up.pt/portal/documents/8/codigo-etico-de-conduta-academica-uporto.pdf">Código de Conduta U.PORTO</a></span></p>
'); -- 25
