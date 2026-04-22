-- ═══════════════════════════════════════════
--  MediCare Database Setup
--  Run this script once to initialize the DB
-- ═══════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS medicare_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE medicare_db;

-- ── Medicines Table ──
CREATE TABLE IF NOT EXISTS medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicine_name VARCHAR(200) NOT NULL,
    generic_name  VARCHAR(200) NOT NULL,
    category      VARCHAR(100) NOT NULL,
    dosage_form   VARCHAR(100) DEFAULT 'Tablet',
    strength      VARCHAR(80)  DEFAULT '',
    price_per_tablet DECIMAL(10,2) NOT NULL,
    currency      VARCHAR(10)  DEFAULT 'TK',
    manufacturer  VARCHAR(200) DEFAULT '',
    description   TEXT,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── Medicines Seed Data (100 medicines) ──
INSERT INTO medicines (medicine_name, generic_name, category, dosage_form, strength, price_per_tablet, currency, manufacturer, description) VALUES
-- Antibiotics
('Amoxil','Amoxicillin','Antibiotic','Capsule','500mg',8.50,'TK','Square Pharma','Broad-spectrum penicillin antibiotic for bacterial infections including pneumonia, ear infections and UTIs.'),
('Zimax','Azithromycin','Antibiotic','Tablet','500mg',25.00,'TK','Square Pharma','Macrolide antibiotic used for respiratory tract infections, skin infections and STIs.'),
('Cipro','Ciprofloxacin','Antibiotic','Tablet','500mg',12.00,'TK','Beximco Pharma','Fluoroquinolone antibiotic effective against urinary tract and respiratory infections.'),
('Moxacil','Amoxicillin + Clavulanate','Antibiotic','Tablet','625mg',22.00,'TK','Incepta Pharma','Combination antibiotic for resistant bacterial infections, sinusitis and ear infections.'),
('Doxilin','Doxycycline','Antibiotic','Capsule','100mg',6.00,'TK','ACI Limited','Tetracycline antibiotic for acne, malaria prevention and Lyme disease.'),
('Cefixime','Cefixime','Antibiotic','Tablet','200mg',18.00,'TK','Drug International','Third-generation cephalosporin for gonorrhea, UTIs and respiratory infections.'),
('Metronid','Metronidazole','Antibiotic','Tablet','400mg',4.50,'TK','Popular Pharma','Anti-bacterial and anti-protozoal for amoeba, giardia and anaerobic infections.'),
('Clindamycin','Clindamycin','Antibiotic','Capsule','300mg',30.00,'TK','Globe Pharma','Lincosamide antibiotic for skin, bone and joint infections.'),

-- Cardiovascular
('Atova','Atorvastatin','Cardiovascular','Tablet','20mg',9.00,'TK','Square Pharma','Statin medication that lowers LDL cholesterol and reduces cardiovascular disease risk.'),
('Amlodip','Amlodipine','Cardiovascular','Tablet','5mg',5.50,'TK','Beximco Pharma','Calcium channel blocker for hypertension and angina management.'),
('Ramipril','Ramipril','Cardiovascular','Tablet','5mg',11.00,'TK','Incepta Pharma','ACE inhibitor used for hypertension, heart failure and kidney protection in diabetes.'),
('Metoprol','Metoprolol Succinate','Cardiovascular','Tablet','50mg',8.00,'TK','ACI Limited','Beta-blocker for hypertension, angina and heart failure.'),
('Losartan','Losartan Potassium','Cardiovascular','Tablet','50mg',10.00,'TK','Drug International','ARB for hypertension and kidney protection in type 2 diabetes.'),
('Digoxin','Digoxin','Cardiovascular','Tablet','0.25mg',3.50,'TK','Square Pharma','Cardiac glycoside for heart failure and atrial fibrillation.'),
('Clopid','Clopidogrel','Cardiovascular','Tablet','75mg',15.00,'TK','Popular Pharma','Anti-platelet drug to prevent heart attack and stroke.'),
('Frusemide','Furosemide','Cardiovascular','Tablet','40mg',2.50,'TK','Beximco Pharma','Loop diuretic for heart failure, edema and hypertension.'),

-- Analgesics / Pain Relief
('Napa','Paracetamol','Analgesic','Tablet','500mg',1.20,'TK','Beximco Pharma','Most commonly used analgesic and antipyretic for pain and fever relief.'),
('Napa Extra','Paracetamol + Caffeine','Analgesic','Tablet','500/65mg',1.80,'TK','Beximco Pharma','Enhanced paracetamol with caffeine for headaches and migraines.'),
('Ibuprofen','Ibuprofen','NSAID','Tablet','400mg',4.00,'TK','Square Pharma','Non-steroidal anti-inflammatory for pain, fever and inflammation.'),
('Diclofenac','Diclofenac Sodium','NSAID','Tablet','50mg',3.50,'TK','Incepta Pharma','NSAID for arthritis, menstrual pain and musculoskeletal disorders.'),
('Naproxen','Naproxen','NSAID','Tablet','250mg',5.00,'TK','ACI Limited','Long-acting NSAID for arthritis, gout and menstrual cramps.'),
('Tramadol','Tramadol HCl','Opioid Analgesic','Capsule','50mg',12.00,'TK','Drug International','Centrally acting opioid for moderate to severe pain.'),
('Celecoxib','Celecoxib','NSAID','Capsule','200mg',25.00,'TK','Globe Pharma','COX-2 selective NSAID with lower GI side effects for arthritis pain.'),

-- Antidiabetics
('Glucophage','Metformin HCl','Antidiabetic','Tablet','500mg',4.00,'TK','Square Pharma','First-line medication for Type 2 diabetes, reduces hepatic glucose production.'),
('Gliclazide','Gliclazide','Antidiabetic','Tablet','80mg',6.00,'TK','Beximco Pharma','Sulfonylurea that stimulates insulin secretion from the pancreas.'),
('Sitagliptin','Sitagliptin','Antidiabetic','Tablet','100mg',45.00,'TK','Incepta Pharma','DPP-4 inhibitor that enhances incretin effects to lower blood glucose.'),
('Empagliflozin','Empagliflozin','Antidiabetic','Tablet','10mg',85.00,'TK','ACI Limited','SGLT2 inhibitor that reduces glucose reabsorption in the kidneys.'),
('Glimepiride','Glimepiride','Antidiabetic','Tablet','2mg',5.50,'TK','Drug International','Long-acting sulfonylurea for Type 2 diabetes management.'),
('Acarbose','Acarbose','Antidiabetic','Tablet','50mg',8.00,'TK','Popular Pharma','Alpha-glucosidase inhibitor slowing carbohydrate absorption.'),

-- Respiratory
('Salbutamol','Salbutamol Sulfate','Respiratory','Tablet','4mg',2.00,'TK','Square Pharma','Short-acting beta-2 agonist for asthma and bronchospasm relief.'),
('Montelukast','Montelukast Sodium','Respiratory','Tablet','10mg',18.00,'TK','Beximco Pharma','Leukotriene receptor antagonist for asthma and allergic rhinitis.'),
('Theophylline','Theophylline','Respiratory','Tablet','200mg',4.50,'TK','Incepta Pharma','Bronchodilator for COPD and asthma maintenance therapy.'),
('Prednisolone','Prednisolone','Corticosteroid','Tablet','5mg',3.00,'TK','ACI Limited','Corticosteroid for severe asthma, allergies and inflammatory conditions.'),
('Fexofenadine','Fexofenadine HCl','Antihistamine','Tablet','120mg',12.00,'TK','Drug International','Non-sedating antihistamine for allergic rhinitis and urticaria.'),
('Cetirizine','Cetirizine HCl','Antihistamine','Tablet','10mg',4.00,'TK','Popular Pharma','Second-generation antihistamine for hay fever, allergies and eczema.'),
('Levocetirizine','Levocetirizine','Antihistamine','Tablet','5mg',6.00,'TK','Globe Pharma','Potent antihistamine for chronic urticaria and allergic rhinoconjunctivitis.'),

-- Antidepressants / Mental Health
('Sertraline','Sertraline HCl','Antidepressant','Tablet','50mg',15.00,'TK','Square Pharma','SSRI for depression, OCD, panic disorder, PTSD and social anxiety.'),
('Fluoxetine','Fluoxetine HCl','Antidepressant','Capsule','20mg',8.00,'TK','Beximco Pharma','SSRI for depression, bulimia, OCD and panic disorder.'),
('Escitalopram','Escitalopram Oxalate','Antidepressant','Tablet','10mg',20.00,'TK','Incepta Pharma','Highly selective SSRI for major depression and generalized anxiety.'),
('Alprazolam','Alprazolam','Anxiolytic','Tablet','0.25mg',5.00,'TK','ACI Limited','Benzodiazepine for anxiety disorders and panic attacks.'),
('Clonazepam','Clonazepam','Anxiolytic','Tablet','0.5mg',6.00,'TK','Drug International','Benzodiazepine for panic disorder, epilepsy and anxiety.'),
('Olanzapine','Olanzapine','Antipsychotic','Tablet','5mg',35.00,'TK','Square Pharma','Atypical antipsychotic for schizophrenia and bipolar disorder.'),
('Quetiapine','Quetiapine Fumarate','Antipsychotic','Tablet','100mg',30.00,'TK','Beximco Pharma','Antipsychotic for schizophrenia, bipolar disorder and depression.'),

-- Gastrointestinal
('Omeprazole','Omeprazole','GI / PPI','Capsule','20mg',5.00,'TK','Square Pharma','Proton pump inhibitor for GERD, peptic ulcers and Helicobacter pylori.'),
('Pantoprazole','Pantoprazole Sodium','GI / PPI','Tablet','40mg',8.00,'TK','Beximco Pharma','PPI for erosive esophagitis, GERD and Zollinger-Ellison syndrome.'),
('Ranitidine','Ranitidine HCl','GI / H2 Blocker','Tablet','150mg',3.50,'TK','Incepta Pharma','H2 receptor blocker for peptic ulcers and GERD.'),
('Domperidone','Domperidone','Antiemetic','Tablet','10mg',4.00,'TK','ACI Limited','Prokinetic for nausea, vomiting and gastroparesis.'),
('Ondansetron','Ondansetron HCl','Antiemetic','Tablet','4mg',12.00,'TK','Drug International','5-HT3 antagonist for chemotherapy and post-operative nausea.'),
('Loperamide','Loperamide HCl','Antidiarrheal','Capsule','2mg',5.00,'TK','Popular Pharma','Opioid receptor agonist for acute and chronic diarrhea.'),
('Lactulose','Lactulose','Laxative','Tablet','10g sachet',8.00,'TK','Globe Pharma','Osmotic laxative for constipation and hepatic encephalopathy.'),
('Mesalazine','Mesalazine','GI Anti-inflammatory','Tablet','400mg',22.00,'TK','Square Pharma','Aminosalicylate for ulcerative colitis and Crohn\'s disease.'),

-- Antimalarials / Antiparasitics
('Coartem','Artemether + Lumefantrine','Antimalarial','Tablet','20/120mg',35.00,'TK','Beximco Pharma','First-line combination therapy for uncomplicated falciparum malaria.'),
('Chloroquine','Chloroquine Phosphate','Antimalarial','Tablet','250mg',4.00,'TK','Incepta Pharma','Antimalarial for vivax malaria prophylaxis and treatment.'),
('Albendazole','Albendazole','Antiparasitic','Tablet','400mg',10.00,'TK','ACI Limited','Broad-spectrum antiparasitic for roundworm, hookworm and tapeworm.'),
('Ivermectin','Ivermectin','Antiparasitic','Tablet','6mg',15.00,'TK','Drug International','Antiparasitic for strongyloidiasis, onchocerciasis and scabies.'),

-- Vitamins / Supplements
('Vitamin C','Ascorbic Acid','Vitamin','Tablet','500mg',2.50,'TK','Square Pharma','Essential vitamin for immune function, collagen synthesis and antioxidant protection.'),
('Vitamin D3','Cholecalciferol','Vitamin','Tablet','1000IU',5.00,'TK','Beximco Pharma','Fat-soluble vitamin for bone health, immune function and calcium absorption.'),
('Folic Acid','Folic Acid','Vitamin','Tablet','5mg',1.50,'TK','Incepta Pharma','B vitamin essential for DNA synthesis, cell division and pregnancy.'),
('Ferrous Sulfate','Ferrous Sulfate','Iron Supplement','Tablet','200mg',2.00,'TK','ACI Limited','Iron supplement for iron-deficiency anemia.'),
('Calcium + D3','Calcium Carbonate + D3','Supplement','Tablet','500mg/200IU',6.00,'TK','Drug International','Combination supplement for bone health and osteoporosis prevention.'),
('Zinc','Zinc Sulfate','Supplement','Tablet','20mg',4.00,'TK','Popular Pharma','Mineral supplement for immune support, wound healing and growth.'),
('Omega-3','Fish Oil (EPA/DHA)','Supplement','Capsule','1000mg',12.00,'TK','Globe Pharma','Omega-3 fatty acids for cardiovascular health and inflammation reduction.'),
('Multivitamin','Multivitamin Complex','Supplement','Tablet','—',8.00,'TK','Square Pharma','Complete daily multivitamin for general health and nutritional gaps.'),

-- Antifungals
('Fluconazole','Fluconazole','Antifungal','Capsule','150mg',18.00,'TK','Beximco Pharma','Triazole antifungal for candidiasis, cryptococcal meningitis and tinea infections.'),
('Itraconazole','Itraconazole','Antifungal','Capsule','100mg',25.00,'TK','Incepta Pharma','Broad-spectrum antifungal for aspergillosis, onychomycosis and systemic fungal infections.'),
('Terbinafine','Terbinafine HCl','Antifungal','Tablet','250mg',20.00,'TK','ACI Limited','Allylamine antifungal specifically for dermatophyte nail and skin infections.'),

-- Antivirals
('Acyclovir','Acyclovir','Antiviral','Tablet','400mg',8.00,'TK','Drug International','Nucleoside analogue for herpes simplex, varicella and herpes zoster.'),
('Oseltamivir','Oseltamivir Phosphate','Antiviral','Capsule','75mg',80.00,'TK','Popular Pharma','Neuraminidase inhibitor for influenza A and B treatment and prevention.'),
('Tenofovir','Tenofovir Disoproxil','Antiviral','Tablet','300mg',55.00,'TK','Globe Pharma','Antiretroviral for HIV/AIDS and chronic hepatitis B treatment.'),

-- Thyroid
('Thyroxine','Levothyroxine Sodium','Thyroid','Tablet','50mcg',5.00,'TK','Square Pharma','Synthetic T4 hormone replacement for hypothyroidism.'),
('Carbimazole','Carbimazole','Antithyroid','Tablet','5mg',4.00,'TK','Beximco Pharma','Antithyroid drug for hyperthyroidism and Graves disease.'),

-- Bone / Musculoskeletal
('Alendronate','Alendronate Sodium','Bisphosphonate','Tablet','70mg',30.00,'TK','Incepta Pharma','Bisphosphonate for osteoporosis prevention and treatment.'),
('Allopurinol','Allopurinol','Antigout','Tablet','100mg',3.50,'TK','ACI Limited','Xanthine oxidase inhibitor for gout and hyperuricemia.'),
('Colchicine','Colchicine','Antigout','Tablet','0.5mg',8.00,'TK','Drug International','Anti-inflammatory for acute gout attacks and familial Mediterranean fever.'),
('Hydroxychloroquine','Hydroxychloroquine Sulfate','DMARD','Tablet','200mg',18.00,'TK','Popular Pharma','Disease-modifying drug for rheumatoid arthritis, lupus and malaria.'),

-- Neurological
('Phenytoin','Phenytoin Sodium','Antiepileptic','Tablet','100mg',5.00,'TK','Globe Pharma','Antiepileptic for tonic-clonic and focal seizures.'),
('Carbamazepine','Carbamazepine','Antiepileptic','Tablet','200mg',6.50,'TK','Square Pharma','Antiepileptic for trigeminal neuralgia and bipolar disorder.'),
('Gabapentin','Gabapentin','Antiepileptic','Capsule','300mg',15.00,'TK','Beximco Pharma','Antiepileptic also used for neuropathic pain and fibromyalgia.'),
('Levodopa/Carbidopa','Levodopa + Carbidopa','Antiparkinsonian','Tablet','250/25mg',12.00,'TK','Incepta Pharma','Gold-standard dopamine precursor therapy for Parkinson\'s disease.'),
('Donepezil','Donepezil HCl','Dementia','Tablet','5mg',45.00,'TK','ACI Limited','Cholinesterase inhibitor for symptomatic treatment of Alzheimer\'s disease.'),

-- Anticoagulants
('Warfarin','Warfarin Sodium','Anticoagulant','Tablet','5mg',4.00,'TK','Drug International','Vitamin K antagonist for atrial fibrillation, DVT and pulmonary embolism.'),
('Rivaroxaban','Rivaroxaban','Anticoagulant','Tablet','20mg',120.00,'TK','Popular Pharma','Direct oral anticoagulant (DOAC) for stroke prevention and VTE treatment.'),
('Heparin','Enoxaparin Sodium','Anticoagulant','Injection','40mg/0.4ml',220.00,'TK','Globe Pharma','Low molecular weight heparin for DVT prophylaxis and ACS.'),

-- Dermatology
('Isotretinoin','Isotretinoin','Dermatology','Capsule','20mg',35.00,'TK','Square Pharma','Retinoid for severe cystic acne; highly effective but teratogenic.'),
('Hydrocortisone','Hydrocortisone','Corticosteroid','Tablet','10mg',5.00,'TK','Beximco Pharma','Mild corticosteroid for adrenal insufficiency and inflammatory conditions.'),
('Dexamethasone','Dexamethasone','Corticosteroid','Tablet','0.5mg',2.50,'TK','Incepta Pharma','Potent corticosteroid for cerebral edema, allergies and COVID-19 severe cases.'),

-- Ophthalmology / ENT
('Betahistine','Betahistine Dihydrochloride','ENT','Tablet','16mg',10.00,'TK','ACI Limited','H1 agonist/H3 antagonist for Meniere\'s disease, vertigo and tinnitus.'),
('Prochlorperazine','Prochlorperazine','Antiemetic','Tablet','5mg',5.50,'TK','Drug International','Phenothiazine antiemetic for nausea, vomiting and vertigo.'),

-- Hormones / Contraceptives
('Norethisterone','Norethisterone','Hormonal','Tablet','5mg',6.00,'TK','Popular Pharma','Progestogen for menstrual disorders, endometriosis and contraception.'),
('Combined OCP','Ethinylestradiol + Levonorgestrel','Contraceptive','Tablet','30/150mcg',5.00,'TK','Globe Pharma','Low-dose combined oral contraceptive pill for pregnancy prevention.'),

-- Renal / Urological
('Tamsulosin','Tamsulosin HCl','Urological','Capsule','0.4mg',20.00,'TK','Square Pharma','Alpha-1 blocker for benign prostatic hyperplasia and ureteral stones.'),
('Sildenafil','Sildenafil Citrate','Urological','Tablet','50mg',80.00,'TK','Beximco Pharma','PDE-5 inhibitor for erectile dysfunction and pulmonary arterial hypertension.'),

-- Miscellaneous
('Ivermectin 12','Ivermectin','Antiparasitic','Tablet','12mg',25.00,'TK','Incepta Pharma','Higher-dose ivermectin for strongyloidiasis and mass deworming programs.'),
('Naltrexone','Naltrexone HCl','Addiction','Tablet','50mg',40.00,'TK','ACI Limited','Opioid antagonist for alcohol and opioid dependence treatment.'),
('Nicotine Patch','Nicotine','Smoking Cessation','Patch','14mg/24hr',150.00,'TK','Drug International','Transdermal nicotine replacement therapy for smoking cessation.'),
('Bisacodyl','Bisacodyl','Laxative','Tablet','5mg',2.50,'TK','Popular Pharma','Stimulant laxative for constipation and bowel preparation.'),
('Magnesium Hydroxide','Magnesium Hydroxide','Antacid','Tablet','400mg',3.00,'TK','Globe Pharma','Antacid for heartburn, indigestion and constipation relief.');

-- ── Patients / New User Welcome Table ──
CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(200) NOT NULL,
    email       VARCHAR(200) UNIQUE NOT NULL,
    phone       VARCHAR(30),
    dob         DATE,
    blood_group VARCHAR(10),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── Page views (optional analytics) ──
CREATE TABLE IF NOT EXISTS page_views (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(100),
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
