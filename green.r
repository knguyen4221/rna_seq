# load libs
library(ggplot2)
library(reshape2)
library(dplyr)

#----------------------------------------------------------------------
# read data
# cases = rows
# reps, types, and brain regions = columns
#setwd("Y:/ProjectsADRC/2017-11-09-KimGreen-rnaseqPlots")
#path <- getwd()
#df <- read.csv(paste0(path, '/EXP-17-AE3143_rpkm_norm_20170501_Dan.csv'), 
#                      header = TRUE, 
#                     na.strings = '')
#dim(df)

#command line arguments
args <- commandArgs(TRUE)

#numerical values on types
valuesToSplit <- args[1]
#valuesToSplit <- "10.27428816,14.26958517,11.64142285,10.77218069,13.12475928,12.49392927,13.96885606,13.43231734,12.17794974,11.34764518,9.90107195,10.53955875,11.36638734,13.54963096,10.89302912,10.75129389,10.69800439,10.59075899,10.19907158,10.72821066,12.69251781,10.42641393,9.96468313,12.05076323,9.85183747,10.08747994,12.01984327,11.90691994,11.06201443,9.06768042,9.99581972,10.56926109,12.71788017,9.78428758,10.99456086,12.54391859,14.88184001,10.10306463,14.34031680,14.08827357,12.57903212,9.77253685,14.41641405,12.02729613,12.92457235,9.97653447,9.88096006,11.81406278"

#column names
keysToSplit <- args[4]
#keysToSplit <- "WT_Con_Cor_1,WT_Con_Cor_2,WT_Con_Cor_3,WT_Con_Cor_4,WT_Plx_Cor_1,WT_Plx_Cor_2,WT_Plx_Cor_3,WT_Plx_Cor_4,AD_Con_Cor_1,AD_Con_Cor_2,AD_Con_Cor_3,AD_Con_Cor_4,AD_Plx_Cor_1,AD_Plx_Cor_2,AD_Plx_Cor_3,AD_Plx_Cor_4,WT_Con_Hip_1,WT_Con_Hip_2,WT_Con_Hip_3,WT_Con_Hip_4,WT_Plx_Hip_1,WT_Plx_Hip_2,WT_Plx_Hip_3,WT_Plx_Hip_4,AD_Con_Hip_1,AD_Con_Hip_2,AD_Con_Hip_3,AD_Con_Hip_4,AD_Plx_Hip_1,AD_Plx_Hip_2,AD_Plx_Hip_3,AD_Plx_Hip_4,WT_Con_Thal_1,WT_Con_Thal_2,WT_Con_Thal_3,WT_Con_Thal_4,WT_Plx_Thal_1,WT_Plx_Thal_2,WT_Plx_Thal_3,WT_Plx_Thal_4,AD_Con_Thal_1,AD_Con_Thal_2,AD_Con_Thal_3,AD_Con_Thal_4,AD_Plx_Thal_1,AD_Plx_Thal_2,AD_Plx_Thal_3,AD_Plx_Thal_4"

#Formatting data input to fit code
gene <- eval(parse(text = paste("data.frame(","'",args[3],"'",",",valuesToSplit,")")))
colnames(gene) <- unlist(strsplit(paste("symbol,",keysToSplit, sep=""), ','))
#------------------------------------------------------------------------

#------------------------------------------------
# helper functions
trr_fun <- function(x){
  x <- unlist(strsplit(as.character(x), '[_]'))
  type <- paste(x[1], x[2], sep = ' ')
  roi <- x[3]
  rep <- x[4]
  trr <- list(type = type, roi = roi, rep = rep)
  return(trr)
}

#------------------------------------------------

#--------------------------------------------------------
# illustrate with gene = Bc1
#gene <- 'Bc1'

# select case and reshape to long format
#df.case <- reshape2::melt(df[df$symbol == gene, -1], id = 'symbol')
df.case <- reshape2::melt(gene, id = 'symbol')

# make df.plot
# define type, region, and sample from condition
df.case %>% dplyr::rowwise() %>% dplyr::mutate(type = trr_fun(variable)[['type']],
                                               region = trr_fun(variable)[['roi']],
                                               sample = trr_fun(variable)[['rep']]) -> df.plot

# tidy levels
df.plot$region <- factor(df.plot$region, levels = c('Cor', 'Hip', 'Thal'), 
                         labels = c('Cortex', 'Hippocampus', 'Thalamus'))
df.plot$type <- factor(df.plot$type, levels = rev(c("WT Con","WT Plx","AD Con","AD Plx")),
                       labels = rev(c("Wild-type (WT)","Wild-type+PLX5622", "5xfAD", "5xfAD+PLX5622")))
levels(df.plot$type) <- rev(levels(df.plot$type))

# plot parameters
units <- 1000
metsblue <- '#002D70'
xlab <- 'Wild-type and AD'
ylab <- paste0('RNA-seq read counts')
#title <- paste0(gene,': RNA sequence read counts')
title <- paste0(args[3],': RNA sequence read counts')

subtitle <- 'Wild-type and AD mice cortex, hippocampus, and thalmus'
caption <- 'Source: Kim Green, PhD. ADRC, UC Irvine.'
type.levels <- levels(df.plot$type)

# the plot  
rnaplot <- ggplot(data = df.plot, aes(x = type, y = value, colour = type)) + 
    stat_summary(fun.y = mean, geom = 'point', colour = metsblue, size = 2.5) +
    stat_summary(fun.data = mean_se, geom = 'linerange', colour = metsblue, size = 1, 
                 fun.args = list(mult = 1)) + 
    geom_point(position = position_jitter(width = 0.15), size = 1.5) +
    facet_grid(region ~ .) + 
    labs(x = xlab, y= ylab, title = title, subtitle = subtitle, caption = caption) +
    scale_colour_brewer(name = "Type", palette = 'Paired') +
    scale_x_discrete(limits = rev(type.levels)) + 
    scale_y_continuous(trans = scales::log10_trans(),
                      breaks = scales::trans_breaks("log10", function(x) 10^x),
                      labels = scales::trans_format("log10", scales::math_format(10^.x))) +
    coord_flip()
    

# left over code                 
ggplot2::ggsave(filename = paste("images/gene_images/",args[2],".png",sep=""), 
  plot = rnaplot, dpi = 300)
