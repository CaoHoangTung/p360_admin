USE [gowork360]
GO
/****** Object:  Table [dbo].[gwplaces]    Script Date: 07/14/2018 17:43:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[gwplaces](
	[id] [int] NOT NULL,
	[name] [nvarchar](50) NULL,
	[image_url] [nvarchar](200) NULL,
	[address] [nvarchar](50) NULL,
	[latitude] [varchar](20) NULL,
	[longitude] [varchar](20) NULL,
	[county] [nvarchar](20) NULL,
	[ward] [nvarchar](50) NULL,
	[status] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[gwgroups]    Script Date: 07/14/2018 17:43:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[gwgroups](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](256) NULL,
	[icon_url] [varchar](256) NULL,
	[parent_id] [int] NULL,
	[create_date] [smalldatetime] NULL,
	[update_date] [smalldatetime] NULL,
	[status] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[gwusers]    Script Date: 07/14/2018 17:43:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[gwusers](
	[user_name] [varchar](256) NOT NULL,
	[password] [varchar](256) NULL,
	[email] [varchar](256) NULL,
	[phone] [varchar](256) NULL,
	[avatar] [varchar](256) NULL,
	[fullname] [nvarchar](50) NULL,
	[birth_day] [date] NULL,
	[gender] [int] NULL,
	[point] [int] NULL,
	[confirm_code] [varchar](4) NULL,
	[type_user] [int] NULL,
	[create_date] [smalldatetime] NULL,
	[update_date] [smalldatetime] NULL,
	[status] [int] NULL,
	[cmnd] [varchar](20) NULL,
	[home_name] [nvarchar](50) NULL,
	[home_address] [nvarchar](50) NULL,
	[company_name] [nvarchar](50) NULL,
	[company_address] [nvarchar](50) NULL,
	[from_place_id] [int] NULL,
	[to_place_id] [int] NULL,
	[schedule_work] [nvarchar](2000) NULL,
PRIMARY KEY CLUSTERED 
(
	[user_name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[gwgroup_place]    Script Date: 07/14/2018 17:43:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gwgroup_place](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[group_id] [int] NULL,
	[place_id] [int] NULL,
	[status] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY],
UNIQUE NONCLUSTERED 
(
	[place_id] ASC,
	[group_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[gwdrivers]    Script Date: 07/14/2018 17:43:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[gwdrivers](
	[user_name] [varchar](256) NOT NULL,
	[password] [varchar](256) NULL,
	[email] [varchar](256) NULL,
	[phone] [varchar](256) NULL,
	[avatar] [varchar](256) NULL,
	[fullname] [nvarchar](50) NULL,
	[birth_day] [date] NULL,
	[gender] [int] NULL,
	[point] [int] NULL,
	[confirm_code] [varchar](4) NULL,
	[type_user] [int] NULL,
	[create_date] [smalldatetime] NULL,
	[update_date] [smalldatetime] NULL,
	[status] [int] NULL,
	[cmnd] [varchar](20) NULL,
	[home_name] [nvarchar](50) NULL,
	[home_address] [nvarchar](50) NULL,
	[company_name] [nvarchar](50) NULL,
	[company_address] [nvarchar](50) NULL,
	[from_place_id] [int] NULL,
	[to_place_id] [int] NULL,
	[schedule_work] [nvarchar](2000) NULL,
	[vehicle_number] [nvarchar](20) NULL,
	[driving_license] [nvarchar](50) NULL,
	[insurrance] [nvarchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[user_name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[gwbook]    Script Date: 07/14/2018 17:43:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gwbook](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[user_name_driver] [nvarchar](256) NULL,
	[user_name] [nvarchar](256) NULL,
	[from_place_id] [int] NULL,
	[to_place_id] [int] NULL,
	[schedule_book] [smalldatetime] NULL,
	[price] [money] NULL,
	[status] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Default [DF__gwdrivers__passw__173876EA]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('389MAm3bfz3CyZ3v2zqw8A==') FOR [password]
GO
/****** Object:  Default [DF__gwdrivers__email__182C9B23]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('389MAm3bfz3CyZ3v2zqw8A==') FOR [email]
GO
/****** Object:  Default [DF__gwdrivers__phone__1920BF5C]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('389MAm3bfz3CyZ3v2zqw8A==') FOR [phone]
GO
/****** Object:  Default [DF__gwdrivers__avata__1A14E395]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('default.png') FOR [avatar]
GO
/****** Object:  Default [DF__gwdrivers__fulln__1B0907CE]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('update letter') FOR [fullname]
GO
/****** Object:  Default [DF__gwdrivers__birth__1BFD2C07]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('1982-10-26') FOR [birth_day]
GO
/****** Object:  Default [DF__gwdrivers__gende__1CF15040]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ((0)) FOR [gender]
GO
/****** Object:  Default [DF__gwdrivers__point__1DE57479]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ((0)) FOR [point]
GO
/****** Object:  Default [DF__gwdrivers__confi__1ED998B2]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ('1234') FOR [confirm_code]
GO
/****** Object:  Default [DF__gwdrivers__type___1FCDBCEB]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ((0)) FOR [type_user]
GO
/****** Object:  Default [DF__gwdrivers__creat__20C1E124]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT (getdate()) FOR [create_date]
GO
/****** Object:  Default [DF__gwdrivers__updat__21B6055D]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT (getdate()) FOR [update_date]
GO
/****** Object:  Default [DF__gwdrivers__statu__22AA2996]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers] ADD  DEFAULT ((0)) FOR [status]
GO
/****** Object:  Default [DF__gwgroup_p__statu__45F365D3]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroup_place] ADD  DEFAULT ((0)) FOR [status]
GO
/****** Object:  Default [DF__gwgroups__name__300424B4]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroups] ADD  DEFAULT ('update later') FOR [name]
GO
/****** Object:  Default [DF__gwgroups__icon_u__30F848ED]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroups] ADD  DEFAULT ('default.png') FOR [icon_url]
GO
/****** Object:  Default [DF__gwgroups__create__32E0915F]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroups] ADD  DEFAULT (getdate()) FOR [create_date]
GO
/****** Object:  Default [DF__gwgroups__update__33D4B598]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroups] ADD  DEFAULT (getdate()) FOR [update_date]
GO
/****** Object:  Default [DF__gwgroups__status__34C8D9D1]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroups] ADD  DEFAULT ((0)) FOR [status]
GO
/****** Object:  Default [DF__gwusers__passwor__0519C6AF]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('389MAm3bfz3CyZ3v2zqw8A==') FOR [password]
GO
/****** Object:  Default [DF__gwusers__email__060DEAE8]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('389MAm3bfz3CyZ3v2zqw8A==') FOR [email]
GO
/****** Object:  Default [DF__gwusers__phone__07020F21]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('389MAm3bfz3CyZ3v2zqw8A==') FOR [phone]
GO
/****** Object:  Default [DF__gwusers__avatar__07F6335A]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('default.png') FOR [avatar]
GO
/****** Object:  Default [DF__gwusers__fullnam__08EA5793]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('update letter') FOR [fullname]
GO
/****** Object:  Default [DF__gwusers__birth_d__09DE7BCC]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('1982-10-26') FOR [birth_day]
GO
/****** Object:  Default [DF__gwusers__gender__0AD2A005]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ((0)) FOR [gender]
GO
/****** Object:  Default [DF__gwusers__point__0BC6C43E]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ((0)) FOR [point]
GO
/****** Object:  Default [DF__gwusers__confirm__0CBAE877]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ('1234') FOR [confirm_code]
GO
/****** Object:  Default [DF__gwusers__type_us__0DAF0CB0]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ((0)) FOR [type_user]
GO
/****** Object:  Default [DF__gwusers__create___0EA330E9]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT (getdate()) FOR [create_date]
GO
/****** Object:  Default [DF__gwusers__update___0F975522]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT (getdate()) FOR [update_date]
GO
/****** Object:  Default [DF__gwusers__status__108B795B]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers] ADD  DEFAULT ((0)) FOR [status]
GO
/****** Object:  ForeignKey [FK__gwbook__from_pla__5629CD9C]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwbook]  WITH CHECK ADD FOREIGN KEY([from_place_id])
REFERENCES [dbo].[gwplaces] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
/****** Object:  ForeignKey [FK__gwbook__to_place__571DF1D5]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwbook]  WITH CHECK ADD FOREIGN KEY([to_place_id])
REFERENCES [dbo].[gwplaces] ([id])
GO
/****** Object:  ForeignKey [FK__gwdrivers__from___239E4DCF]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers]  WITH CHECK ADD FOREIGN KEY([from_place_id])
REFERENCES [dbo].[gwplaces] ([id])
GO
/****** Object:  ForeignKey [FK__gwdrivers__to_pl__24927208]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwdrivers]  WITH CHECK ADD FOREIGN KEY([to_place_id])
REFERENCES [dbo].[gwplaces] ([id])
GO
/****** Object:  ForeignKey [FK__gwgroup_p__group__440B1D61]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroup_place]  WITH CHECK ADD FOREIGN KEY([group_id])
REFERENCES [dbo].[gwgroups] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
/****** Object:  ForeignKey [FK__gwgroup_p__place__44FF419A]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroup_place]  WITH CHECK ADD FOREIGN KEY([place_id])
REFERENCES [dbo].[gwplaces] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
/****** Object:  ForeignKey [FK__gwgroups__parent__31EC6D26]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwgroups]  WITH CHECK ADD FOREIGN KEY([parent_id])
REFERENCES [dbo].[gwgroups] ([id])
GO
/****** Object:  ForeignKey [FK__gwusers__from_pl__117F9D94]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers]  WITH CHECK ADD FOREIGN KEY([from_place_id])
REFERENCES [dbo].[gwplaces] ([id])
GO
/****** Object:  ForeignKey [FK__gwusers__to_plac__1273C1CD]    Script Date: 07/14/2018 17:43:19 ******/
ALTER TABLE [dbo].[gwusers]  WITH CHECK ADD FOREIGN KEY([to_place_id])
REFERENCES [dbo].[gwplaces] ([id])
GO
