#include <stdio.h>
#include <stdlib.h>
#include <conio.h>
#include <string.h>

#define LINE_BUF_SIZE  (10240*4)
#define WORD_BUF_SIZE  (10240)
#define NAME_LEN       (2048)
#define IPADR_LEN      (64)
#define GROUP_NAME_LEN (2048)
#define ANSWER_LEN     (4096)
#define DATE_LEN       (256)
#define TIME_LEN       (256)
#define EMAIL_LEN      (1024)
#define MAX_EVENTS     (2000)
#define MAX_USERS      (1000)
#define MAX_QODANS     (3000)

#define EVT_COUNT      (36)

#define CURR_TABLE_NO_INFO  0
#define CURR_TABLE_EVT_INFO 1
#define CURR_TABLE_QOD_INFO 2
#define CURR_TABLE_USR_INFO 3

char lineBuf[LINE_BUF_SIZE];
char wordBuf[WORD_BUF_SIZE];

typedef struct
{
  int count;
  char evtDate[DATE_LEN];
  char evtTime[TIME_LEN];
  char evtName[NAME_LEN];
}T_evtData;

typedef struct
{
  int no;
  char name[NAME_LEN];
  char ipAdr[IPADR_LEN];
  int evtId;
  int groupId;
  char groupName[GROUP_NAME_LEN];
}T_evtInfo;

typedef struct
{
  int qid;
  int no;
  char name[NAME_LEN];
  char ipAdr[IPADR_LEN];
  char ans[ANSWER_LEN];
  char date[DATE_LEN];
}T_qodInfo;

typedef struct
{
  int no;
  char uname[NAME_LEN];
  char name[NAME_LEN];
  char email[EMAIL_LEN];
  char date[DATE_LEN];
  int level;
  char ipAdr[IPADR_LEN];
}T_usrInfo;

T_evtInfo evtInfo[MAX_EVENTS];
int evtIdx = 0;
T_qodInfo qodInfo[MAX_QODANS];
int qodIdx = 0;
T_usrInfo usrInfo[MAX_USERS];
int usrIdx = 0;

T_evtData evtData[EVT_COUNT] = {
  /* 0 */  {1, "", "", ""}, 
  /* 1 */  {1, "", "", ""}, 
  /* 2 */  {1, "", "", ""}, 
  /* 3 */  {1, "", "", ""}, 
  /* 4 */  {1, "", "", ""}, 
  /* 5 */  {1, "", "", ""}, 
  /* 6 */  {1, "", "", ""}, 
  /* 7 */  {1, "", "", ""}, 
  /* 8 */  {1, "", "", ""}, 
  /* 9 */  {1, "", "", ""}, 
  /* 10 */ {1, "", "", ""}, 
  /* 11 */ {1, "", "", ""}, 
  /* 12 */ {1, "", "", ""}, 
  /* 13 */ {1, "", "", ""}, 
  /* 14 */ {1, "", "", ""}, 
  /* 15 */ {1, "", "", ""}, 
  /* 16 */ {1, "", "", ""}, 
  /* 17 */ {1, "", "", ""}, 
  /* 18 */ {1, "", "", ""}, 
  /* 19 */ {1, "", "", ""}, 
  /* 20 */ {1, "", "", ""}, 
  /* 21 */ {1, "", "", ""}, 
  /* 22 */ {1, "", "", ""}, 
  /* 23 */ {1, "", "", ""}, 
  /* 24 */ {1, "", "", ""}, 
  /* 25 */ {1, "", "", ""}, 
  /* 26 */ {1, "", "", ""}, 
  /* 27 */ {1, "", "", ""}, 
  /* 28 */ {1, "", "", ""}, 
  /* 29 */ {1, "", "", ""}, 
  /* 30 */ {1, "", "", ""}, 
  /* 31 */ {1, "", "", ""}, 
  /* 32 */ {1, "", "", ""}, 
  /* 33 */ {1, "", "", ""}, 
  /* 34 */ {1, "", "", ""}, 
  /* 35 */ {1, "", "", ""}
};

int main(int argc, char* argv[])
{
  FILE* fp = NULL;
  int currTable = CURR_TABLE_NO_INFO;
  int i, j, k;
  int teamSize;

  if(argc >= 2)
  {
    fopen_s(&fp, argv[1], "r");

    if(fp != NULL)
    {
      while(fgets(&lineBuf[0], LINE_BUF_SIZE, fp) > 0)
      {
        if(strstr(&lineBuf[0], "INSERT INTO"))
        {
          sscanf_s(&lineBuf[0], "INSERT INTO `%[^`]`", &wordBuf[0], WORD_BUF_SIZE);

          if(strcmp(&wordBuf[0], "userinfo") == 0)
          {
            currTable = CURR_TABLE_USR_INFO;
          }
          else if(strcmp(&wordBuf[0], "qod") == 0)
          {
            currTable = CURR_TABLE_QOD_INFO;
          }
          else if(strcmp(&wordBuf[0], "eventinfo") == 0)
          {
            currTable = CURR_TABLE_EVT_INFO;
          }
          else
          {
            currTable = CURR_TABLE_NO_INFO;
          }
        }
        else if(lineBuf[0] == '(')
        {
          if(currTable == CURR_TABLE_EVT_INFO)
          {
            if(evtIdx < MAX_EVENTS)
            {
              sscanf_s(&lineBuf[0], "(%d, '%[^']', '%[^']', %d, %d, '%[^']')", &evtInfo[evtIdx].no, &evtInfo[evtIdx].name[0], NAME_LEN, 
                                                                               &evtInfo[evtIdx].ipAdr[0], IPADR_LEN, 
                                                                               &evtInfo[evtIdx].evtId, &evtInfo[evtIdx].groupId, 
                                                                               &evtInfo[evtIdx].groupName[0], GROUP_NAME_LEN);
              evtIdx++;
            }
          }
          else if(currTable == CURR_TABLE_QOD_INFO)
          {
            if(qodIdx < MAX_USERS)
            {
              sscanf_s(&lineBuf[0], "(%d, %d, '%[^']', '%[^']', '%[^']', '%[^']')", &qodInfo[qodIdx].qid, &qodInfo[qodIdx].no, 
                                                                                    &qodInfo[qodIdx].name[0], NAME_LEN, 
                                                                                    &qodInfo[qodIdx].ipAdr[0], IPADR_LEN, 
                                                                                    &qodInfo[qodIdx].ans[0], ANSWER_LEN, 
                                                                                    &qodInfo[qodIdx].date[0], DATE_LEN);
              qodIdx++;
            }
          }
          else if(currTable == CURR_TABLE_USR_INFO)
          {
            if(usrIdx < MAX_QODANS)
            {
              sscanf_s(&lineBuf[0], "(%d, '%[^']', '%[^']', '%[^']', '%[^']', %d, '%[^']')", &usrInfo[usrIdx].no, &usrInfo[usrIdx].uname[0], NAME_LEN,
                                                                                             &usrInfo[usrIdx].name[0], NAME_LEN, 
                                                                                             &usrInfo[usrIdx].email[0], EMAIL_LEN, 
                                                                                             &usrInfo[usrIdx].date[0], DATE_LEN, 
                                                                                             &usrInfo[usrIdx].level, &usrInfo[usrIdx].ipAdr[0], IPADR_LEN);
              usrIdx++;
            }
          }
          else
          {
          }
        }
        else
        {
        }
      }

      fclose(fp);
      fp = NULL;

      /* Now filter the results and write files */
      for(i=0;i<EVT_COUNT;i++)
      {
        sprintf_s(&wordBuf[0], WORD_BUF_SIZE, "evt_%d", i);
        fopen_s(&fp, &wordBuf[0], "w");

        if(fp != NULL)
        {
          fprintf(fp, "<h3> Registration </h3>");
          fprintf(fp, "<!--[if !IE]> --><div class=\"lineSepSmall\"></div><!-- <![endif]-->");
          fprintf(fp, "<table style=\"width:87%;text-align:center;margin-left:3%;\">");

          if(evtData[i].count == 1)
          {
            fprintf(fp, "<tr style=\"width:100%;background-color:#666666;\"><td style=\"width:10%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> Sl.No. </td>");
            fprintf(fp, "<td style=\"width:30%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> Name </td>");
            fprintf(fp, "<td style=\"width:60%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> Email ID </td></tr>");
          }
          else
          {
            fprintf(fp, "<tr style=\"width:100%;background-color:#666666;\"><td style=\"width:6%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> Sl.No. </td>");
            fprintf(fp, "<td style=\"width:21%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> GroupName </td>");
            fprintf(fp, "<td style=\"width:21%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> Name </td>");
            fprintf(fp, "<td style=\"width:51%;border:1px solid black;color:#cccccc;vertical-align:middle;\"> Email ID </td></tr>");
          }

          memset(&wordBuf[0], 0, WORD_BUF_SIZE);

          for(j=0;j<evtIdx;j++)
          {
            if(evtInfo[j].evtId == i)
            {
              if(evtData[i].count == 1)
              {
                fprintf(fp, "<tr style=\"width:100%;\"><td style=\"width:10%;border:1px solid black;font-family:philosopher;vertical-align:middle;\">' . $i . '</td>");
                fprintf(fp, "<td style=\"width:30%;border:1px solid black;font-family:philosopher;vertical-align:middle;\"> %s </td>", &evtInfo[j].name[0]);
                fprintf(fp, "<td style=\"width:60%;border:1px solid black;font-family:philosopher;vertical-align:middle;\">%s </td></tr>", "");
              }
              else
              {
                if(strcmp(&evtInfo[j].groupName[0], &wordBuf[0]))
                {
                  for(k=teamSize;k<evtData[i].count;k++)
                  {
                    fprintf(fp, "<tr style=\"width:100%;\">");
                    fprintf(fp, "<td style=\"width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;\"> &nbsp; </td>");
                    fprintf(fp, "<td style=\"width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;\"> &nbsp; </td></tr>");
                  }
                  teamSize = 1;

                  fprintf(fp, "<tr style=\"width:100%;\"><td style=\"width:6%;border:1px solid black;font-family:philosopher;vertical-align:middle;\" rowspan=\"%d\">%d</td>", evtData[i].count, j);
                  fprintf(fp, "<td style=\"width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;\" rowspan=\"%d\">%s</td>", evtData[i].count, evtInfo[j].groupName[0]);
                  fprintf(fp, "<td style=\"width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;\"> %s </td>", evtInfo[j].name[0]);
                  fprintf(fp, "<td style=\"width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;\">%s </td></tr>", "");
                }
                else
                {
                  fprintf(fp, "<tr style=\"width:100%;\">");
                  fprintf(fp, "<td style=\"width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;\"> %s </td>", evtInfo[j].name[0]);
                  fprintf(fp, "<td style=\"width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;\"> %s </td></tr>", "");
                  teamSize++;
                }

                strcpy_s(&wordBuf[0], WORD_BUF_SIZE, &evtInfo[j].groupName[0]);
              }
            }
          }

          fclose(fp);
          fp = NULL;
        }
      }
    }
    else
    {
      printf("\n File not opened");
    }
  }
  else
  {
    printf("\n SQL File name required......");
  }

  return 0;
}

